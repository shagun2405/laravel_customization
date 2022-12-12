<?php

namespace Webkul\Product\Type;

use Webkul\Product\Models\ProductFlat;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Product\Repositories\ProductImageRepository;
use Webkul\Product\Repositories\ProductVideoRepository;
use Webkul\Product\Repositories\ProductInventoryRepository;
use Webkul\Product\Repositories\ProductAttributeValueRepository;
use Webkul\Product\Repositories\ProductGroupedProductRepository;

class Grouped extends AbstractType
{
    /**
     * ProductGroupedProductRepository instance
     *
     * @var \Webkul\Product\Repositories\ProductGroupedProductRepository
     */
    protected $productGroupedProductRepository;

    /**
     * Skip attribute for downloadable product type
     *
     * @var array
     */
    protected $skipAttributes = ['price', 'cost', 'special_price', 'special_price_from', 'special_price_to', 'length', 'width', 'height', 'weight'];

    /**
     * These blade files will be included in product edit page
     *
     * @var array
     */
    protected $additionalViews = [
        'admin::catalog.products.accordians.images',
        'admin::catalog.products.accordians.categories',
        'admin::catalog.products.accordians.grouped-products',
        'admin::catalog.products.accordians.channels',
        'admin::catalog.products.accordians.product-links',
        'admin::catalog.products.accordians.videos',
    ];

    /**
     * Is a composite product type
     *
     * @var boolean
     */
    protected $isComposite = true;

    /**
     * Create a new product type instance.
     *
     * @param  \Webkul\Attribute\Repositories\AttributeRepository            $attributeRepository
     * @param  \Webkul\Product\Repositories\ProductRepository                $productRepository
     * @param  \Webkul\Product\Repositories\ProductAttributeValueRepository  $attributeValueRepository
     * @param  \Webkul\Product\Repositories\ProductInventoryRepository       $productInventoryRepository
     * @param  \Webkul\Product\Repositories\ProductImageRepository           $productImageRepository
     * @param  \Webkul\Product\Repositories\ProductGroupedProductRepository  $productGroupedProductRepository
     * @param  \Webkul\Product\Repositories\ProductVideoRepository           $productVideoRepository
     * @return void
     */
    public function __construct(
        AttributeRepository $attributeRepository,
        ProductRepository $productRepository,
        ProductAttributeValueRepository $attributeValueRepository,
        ProductInventoryRepository $productInventoryRepository,
        ProductImageRepository $productImageRepository,
        ProductGroupedProductRepository $productGroupedProductRepository,
        ProductVideoRepository $productVideoRepository
    ) {
        parent::__construct(
            $attributeRepository,
            $productRepository,
            $attributeValueRepository,
            $productInventoryRepository,
            $productImageRepository,
            $productVideoRepository
        );

        $this->productGroupedProductRepository = $productGroupedProductRepository;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \Webkul\Product\Contracts\Product
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $product = parent::update($data, $id, $attribute);
        
        $route = request()->route() ? request()->route()->getName() : '';

        if ($route != 'admin.catalog.products.massupdate') {
            $this->productGroupedProductRepository->saveGroupedProducts($data, $product);
        }

        return $product;
    }

    /**
     * Returns children ids
     *
     * @return array
     */
    public function getChildrenIds()
    {
        return array_unique($this->product->grouped_products()->pluck('associated_product_id')->toArray());
    }

    /**
     * Check if catalog rule can be applied
     *
     * @return bool
     */
    public function priceRuleCanBeApplied()
    {
        return false;
    }

    /**
     * Get product minimal price.
     *
     * @return float
     */
    public function getMinimalPrice($qty = null)
    {
        $minPrices = [];

        foreach ($this->product->grouped_products as $groupOptionProduct) {
            $groupOptionProductTypeInstance = $groupOptionProduct->associated_product->getTypeInstance();

            $groupOptionProductMinimalPrice = $groupOptionProductTypeInstance->getMinimalPrice();

            $minPrices[] = $groupOptionProductTypeInstance->evaluatePrice($groupOptionProductMinimalPrice);
        }

        return empty($minPrices) ? 0 : min($minPrices);
    }

    /**
     * @return bool
     */
    public function isSaleable()
    {
        if (!$this->product->status) {
            return false;
        }

        if (ProductFlat::query()->select('id')->whereIn('product_id', $this->getChildrenIds())->where('status', 0)->first()) {
            return false;
        }

        return true;
    }

    /**
     * Get group product special price
     *
     * @return boolean
     */
    private function checkGroupProductHaveSpecialPrice()
    {
        $haveSpecialPrice = false;
        foreach ($this->product->grouped_products as $groupOptionProduct) {
            if ($groupOptionProduct->associated_product->getTypeInstance()->haveSpecialPrice()) {
                $haveSpecialPrice = true;
                break;
            }
        }
        return $haveSpecialPrice;
    }

    /**
     * Get product minimal price
     *
     * @return string
     */
    public function getPriceHtml()
    {
        $html = '';

        if ($this->checkGroupProductHaveSpecialPrice()) {
            $html .= '<div class="sticker sale">' . trans('shop::app.products.sale') . '</div>';
        }

        $html .= '<span class="price-label">' . trans('shop::app.products.starting-at') . '</span>'
            . ' '
            . '<span class="final-price">' . core()->currency($this->getMinimalPrice()) . '</span>';

        return $html;
    }

    /**
     * Add product. Returns error message if can't prepare product.
     *
     * @param  array  $data
     * @return array
     */
    public function prepareForCart($data)
    {
        if (!isset($data['qty']) || !is_array($data['qty'])) {
            return trans('shop::app.checkout.cart.integrity.missing_options');
        }
        $products = [];
        foreach ($data['qty'] as $productId => $qty) {
            if (!$qty) {
                continue;
            }
            $additionalAttriubtes = [
                'product_id' => $productId,
                'quantity'   => $qty,
            ];
            
            if (!empty($data['seller_info'])) {
                $additionalAttriubtes['seller_info'] = [
                    'product_id' => $productId,
                    'seller_id' => $data['seller_info']['seller_id'],
                    'is_owner'  => $data['seller_info']['is_owner']
                ];
                if (empty($data['seller_info']['is_owner'])) {
                    $additionalAttriubtes['product_type'] = 'grouped_product_type';
                    $additionalAttriubtes['grouped_product_id'] = $data['product_id'];
                    $additionalAttriubtes['seller_id'] = $data['seller_info']['seller_id'];
                }
            }
            $product = $this->productRepository->find($productId);

            $cartProducts = $product->getTypeInstance()->prepareForCart($additionalAttriubtes);
            $cartProducts = $this->sellerPriceOfGroupedProduct($cartProducts, $data);
          

            if (is_string($cartProducts)) {
                return $cartProducts;
            }
            $products = array_merge($products, $cartProducts);
        }
        if (!count($products)) {
            return trans('shop::app.checkout.cart.integrity.qty_missing');
        }

        return $products;
    }

    /*
       This method is used to replace price of product with seller grouped products price,
       When seller sell admin grouped product with own price.
    */
    public function sellerPriceOfGroupedProduct($cartItem, $requestData)
    {
        if (is_array($cartItem)) {
            if(!empty($requestData['seller_info'])){
                if (empty($requestData['seller_info']['is_owner'])) {
    
                    $cartItemCollection = collect($cartItem)->map(function ($item, $key) {
                     
                        $mainGroupedProductId = $item['additional']['grouped_product_id'];
                        $associatedProductId =  $item['product_id'];
                        $sellerId = $item['additional']['seller_id'];
                        /*Find associated products group details*/
                        $productGroupedDetail = \DB::table('product_grouped_products')->where([['product_id', '=', $mainGroupedProductId], ['associated_product_id','=',$associatedProductId]])->first();
                        if ($productGroupedDetail != NULL) {
                            $sellerPriceofAssociatesProduct =  \DB::table('mp_grouped_product_price')->where([
                                ['product_grouped_product_id', '=', $productGroupedDetail->id],
                                ['marketplace_seller_id', '=', $sellerId]
                            ])->first();
                            if($sellerPriceofAssociatesProduct != NULL){
                                $item['price']        = $sellerPriceofAssociatesProduct->seller_sell_price;
                                $item['base_price']   = $sellerPriceofAssociatesProduct->seller_sell_price;
                                $item['total']        = ($sellerPriceofAssociatesProduct->seller_sell_price * $item['quantity']);
                                $item['base_total'] = ($sellerPriceofAssociatesProduct->seller_sell_price * $item['quantity']);
                                
                                return $item;
                            }else{
                                return $item;
                            }
                        } else {
                            return $item;
                        }
                        return $item;
                    })->all();
                    return $cartItemCollection;
                }
                return $cartItem;
            }
            return $cartItem;
        }
        return $cartItem;
    }
}
