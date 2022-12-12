<?php

namespace Webkul\Marketplace\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Marketplace\Contracts\SellerProductType as SellerProductTypeContract;
use DB;
use Maatwebsite\Excel\Concerns\ToArray;

class SellerProductType extends Model implements SellerProductTypeContract
{
    protected $table = 'mp_seller_allowed_product_type';

    protected $fillable = [
        'product_type',
        'status',
        'created_at',
        'updated_at'
    ];

    //SellerAssignProductType
    public function scopeSellerAssignProductType($query , $sellerId = NULL)
    {
        $sellerAssignedProductTypes = DB::table('seller_producttype')->where('marketplace_sellers_id',$sellerId)->pluck('product_type')->toArray();

        $query->where('status','active');
        if(count($sellerAssignedProductTypes) > 0){
            $query->whereIn('product_type',$sellerAssignedProductTypes);
        }
        $allowedCategory =  $query->pluck('product_type')->toArray();
        return $allowedCategory;
    }

    //SellerAssignedProductType
    public function scopeSellerAssignedProductType($query , $sellerId = NULL)
    {   
        
        $sellerAssignedProductTypes = DB::table('seller_producttype')->where('marketplace_sellers_id',$sellerId)->get();
      
        $productTypes =  $query->where('status','active')->get();

        if($productTypes->count() > 0){
            $productTypes = $productTypes->filter(function($productType, $key) use($sellerAssignedProductTypes){
                                if($sellerAssignedProductTypes->count() > 0){
                                    if($sellerAssignedProductTypes->firstWhere('product_type',$productType->product_type)){
                                        $productType->selected = 1;
                                    }else{
                                        $productType->selected = 0;
                                    }       
                                }else{
                                    $productType->selected = 1;
                                }
                                return $productType;      
                            });
            return $productTypes;
        }
    }
}
