@if ($product->product->type == 'bundle')

    @php
        $locale = core()->checkRequestedLocaleCodeInRequestedChannel();
    @endphp

    <accordian :title="'{{ __('admin::app.catalog.products.bundle-items') }}'" :active="true">
        <div slot="body">
            <bundle-option-list></bundle-option-list>
        </div>
    </accordian>
    
    @push('scripts')
        <script type="text/x-template" id="bundle-option-list-template">
            <div class="">

                <bundle-option-item 
                    v-for='(option, index) in options'
                    :option="option"
                    :key="index"
                    :index="index"
                ></bundle-option-item>
            </div>
        </script>
        
        <script type="text/x-template" id="bundle-option-item-template">
            <accordian :active="true">
                <div slot="header">
                    <i class="icon expand-icon left"></i>
                    <h1 v-if="option.label">@{{ option.label }}</h1>
                    <h1 v-else>{{ __('admin::app.catalog.products.new-option') }}</h1>
                </div>

                <div slot="body">
                    <div class="control-group" :class="[errors.has(titleInputName + '[label]') ? 'has-error' : '']">
                        <label class="required">{{ __('admin::app.catalog.products.option-title') }}</label>

                        <input type="text" v-validate="'required'" :name="titleInputName + '[label]'" v-model="option.label" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.option-title') }}&quot;" disabled/>
                        
                        <span class="control-error" v-if="errors.has(titleInputName + '[label]')">@{{ errors.first(titleInputName + '[label]') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has(inputName + '[type]') ? 'has-error' : '']">
                        <label class="required">{{ __('admin::app.catalog.products.input-type') }}</label>

                        <select v-validate="'required'" :name="inputName + '[type]'" v-model="option.type" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.input-type') }}&quot;" disabled>
                            <option value="select">{{ __('admin::app.catalog.products.select') }}</option>
                            <option value="radio">{{ __('admin::app.catalog.products.radio') }}</option>
                            <option value="checkbox">{{ __('admin::app.catalog.products.checkbox') }}</option>
                            <option value="multiselect">{{ __('admin::app.catalog.products.multiselect') }}</option>
                        </select>
                        
                        <span class="control-error" v-if="errors.has(inputName + '[type]')">@{{ errors.first(inputName + '[type]') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has(inputName + '[is_required]') ? 'has-error' : '']">
                        <label class="required">{{ __('admin::app.catalog.products.is-required') }}</label>

                        <select v-validate="'required'" :name="inputName + '[is_required]'" v-model="option.is_required" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.is-required') }}&quot;" disabled>
                            <option value="1">{{ __('admin::app.catalog.products.yes') }}</option>
                            <option value="0">{{ __('admin::app.catalog.products.no') }}</option>
                        </select>
                        
                        <span class="control-error" v-if="errors.has(inputName + '[is_required]')">@{{ errors.first(inputName + '[is_required]') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has(inputName + '[sort_order]') ? 'has-error' : '']">
                        <label class="required">{{ __('admin::app.catalog.products.sort-order') }}</label>

                        <input type="text" v-validate="'required|numeric|min_value:0'" :name="inputName + '[sort_order]'" v-model="option.sort_order" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.sort-order') }}&quot;" disabled/>
                        
                        <span class="control-error" v-if="errors.has(inputName + '[sort_order]')">@{{ errors.first(inputName + '[sort_order]') }}</span>
                    </div>

                    <div class="section">
                        <div class="secton-title">
                            <span>Products</span>
                        </div>
                        
                        <div class="section-content">
                            <bundle-product-list
                                :bundle-option-products="option.bundle_option_products"
                                :bundle-option="option"
                                :control-name="inputName">
                            </bundle-product-list>
                        </div>
                    </div>
                </div>
            </accordian>
        </script>

        <script type="text/x-template" id="bundle-product-list-template">
            <div>
                
                <div class="table" style="margin-top: 20px; overflow-x: unset;">
                    <table>

                        <thead>
                            <tr>
                                <th class="name">{{ __('admin::app.catalog.products.is-default') }}</th>
                                <th class="name">{{ __('admin::app.catalog.products.name') }}</th>
                                <th class="sku">{{ __('admin::app.catalog.products.sku') }}</th>
                                <th class="qty">{{ __('admin::app.catalog.products.qty') }}</th>
                                <th class="sort-order">{{ __('admin::app.catalog.products.sort-order') }}</th>
                                <th class="actions"></th>
                            </tr>
                        </thead>

                        <tbody>

                            <bundle-product-item
                                v-for='(product, index) in bundle_option_products'
                                :bundle-option="bundleOption"
                                :product="product"
                                :key="index"
                                :index="index"
                                :control-name="controlName"
                                @onCheckProduct="checkProduct($event)">
                            </bundle-product-item>

                        </tbody>

                    </table>
                </div>
            </div>
        </script>

        <script type="text/x-template" id="bundle-product-item-template">
            <tr>
                <td>
                    <div class="control-group" v-if="bundleOption.type == 'radio' || bundleOption.type == 'select'">
                        <span class="radio">
                            <input type="radio" :name="[inputName + '[is_default]']" :id="[inputName + '[is_default]']" :value="product.is_default" @click="checkProduct($event)" :checked="product.is_default" disabled>
                            <label class="radio-view" :for="[inputName + '[is_default]']"></label>
                        </span>
                    </div>

                    <div class="control-group" v-else>
                        <span class="checkbox">
                            <input type="checkbox" :name="[inputName + '[is_default]']" :id="[inputName + '[is_default]']" :value="product.is_default" @click="checkProduct($event)" :checked="product.is_default" disabled>
                            <label class="checkbox-view" :for="[inputName + '[is_default]']"></label>
                        </span>
                    </div>
                </td>

                <td>
                    @{{ product.product.name }}
                    <input type="hidden" :name="[inputName + '[product_id]']" :value="product.product.id"/>
                </td>

                <td>@{{ product.product.sku }}</td>

                <td>
                    <div class="control-group" :class="[errors.has(inputName + '[qty]') ? 'has-error' : '']">
                        <input type="number" v-validate="'required|min_value:1'" :name="[inputName + '[qty]']" v-model="product.qty" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.qty') }}&quot;" disabled/>
                        <span class="control-error" v-if="errors.has(inputName + '[qty]')">@{{ errors.first(inputName + '[qty]') }}</span>
                    </div>
                </td>

                <td>
                    <div class="control-group" :class="[errors.has(inputName + '[sort_order]') ? 'has-error' : '']">
                        <input type="number" v-validate="'required|min_value:1'" :name="[inputName + '[sort_order]']" v-model="product.sort_order" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.products.sort-order') }}&quot;" disabled/>
                        <span class="control-error" v-if="errors.has(inputName + '[sort_order]')">@{{ errors.first(inputName + '[sort_order]') }}</span>
                    </div>
                </td>
            </tr>
        </script>

        <script>
            Vue.component('bundle-option-list', {

                template: '#bundle-option-list-template',

                inject: ['$validator'],

                data: function() {
                    return {
                        options: @json($product->product->bundle_options()->with(['product', 'bundle_option_products', 'bundle_option_products.product'])->get())
                    }
                },
            });

            Vue.component('bundle-option-item', {

                template: '#bundle-option-item-template',

                props: ['index', 'option'],

                inject: ['$validator'],

                computed: {
                    titleInputName: function () {
                        if (this.option.id)
                            return "bundle_options[" + this.option.id + "]" + '[{{$locale}}]';

                        return "bundle_options[option_" + this.index + "]" + '[{{$locale}}]';
                    },

                    inputName: function () {
                        if (this.option.id)
                            return "bundle_options[" + this.option.id + "]";

                        return "bundle_options[option_" + this.index + "]";
                    }
                },
            });

            Vue.component('bundle-product-list', {

                template: '#bundle-product-list-template',

                inject: ['$validator'],

                props: ['controlName', 'bundleOption', 'bundleOptionProducts'],

                data: function() {
                    return {
                        search_term: '',

                        is_searching: false,

                        searched_results: [],

                        bundle_option_products: this.bundleOptionProducts
                    }
                },

                methods: {
                    addProduct: function(item, key) {
                        var alreadyAdded = false;
                        
                        this.bundle_option_products.forEach(function(optionProduct) {
                            if (item.id == optionProduct.product.id) {
                                alreadyAdded = true;
                            }
                        });

                        if (! alreadyAdded) {
                            this.bundle_option_products.push({
                                    product: item,
                                    qty: 0,
                                    is_default: 0,
                                    sort_order: 0
                                });
                        }

                        this.search_term = '';

                        this.searched_result = [];
                    },

                    checkProduct: function(productId) {
                        var this_this = this;

                        this.bundle_option_products.forEach(function(product) {
                            if (this_this.bundleOption.type == 'radio' || this_this.bundleOption.type == 'select') {
                                product.is_default = product.product.id == productId ? 1 : 0;
                            } else {
                                if (product.product.id == productId)
                                    product.is_default = product.is_default ? 0 : 1;
                            }
                        });
                    }
                }
            });

            Vue.component('bundle-product-item', {

                template: '#bundle-product-item-template',

                props: ['controlName', 'index', 'bundleOption', 'product'],

                inject: ['$validator'],

                computed: {
                    inputName: function () {
                        if (this.product.id)
                            return this.controlName + "[products][" + this.product.id + "]";

                        return this.controlName + "[products][product_" + this.index + "]";
                    }
                },

                methods: {
                    checkProduct: function($event) {
                        this.$emit('onCheckProduct', this.product.product.id)
                    }
                }
            });
        </script>
    @endpush
@endif