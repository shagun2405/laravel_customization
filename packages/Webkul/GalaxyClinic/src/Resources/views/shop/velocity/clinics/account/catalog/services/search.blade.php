@extends('shop::customers.account.index')

@section('page_title')
    {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.search-title') }}
@endsection

@section('page-detail-wrapper')

    <div class="account-layout">

        <div class="account-head mb-10">
            <span class="account-heading">
                {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.search-title') }}
            </span>

            <div class="account-action">
            </div>

            <div class="horizontal-rule"></div>
        </div>

        {!! view_render_event('galaxyclinic.clinic.account.catalog.services.search.before') !!}

        <div class="account-items-list">

            <div class="form-container" style="margin-top: 40px">

                <product-search></product-search>

            </div>

        </div>

        {!! view_render_event('galaxyclinic.clinic.account.catalog.services.search.after') !!}

    </div>

@endsection

@push('scripts')

    <script type="text/x-template" id="product-search-template">

        <div class="control-group">
            <label for="search">{{ __('galaxyclinic::app.shop.clinic.account.catalog.services.search') }}</label>
            <input type="text" class="form-style dropdown-toggle" name="search" placeholder="{{ __('galaxyclinic::app.shop.clinic.account.catalog.services.search-term') }}" autocomplete="off" v-model.lazy="term" v-debounce="500"/>

            <div class="dropdown-list bottom-left product-search-list" style="top: 68px; width: 70%; display:contents">
                <div class="dropdown-container">
                    <ul type="none">
                        <li v-if="services.length" class="table">
                            <table>
                                <tbody>
                                    <tr v-for='(product, index) in services'>
                                        <td>
                                            <img v-if="!product.base_image" src="{{ bagisto_asset('images/Default-Product-Image.png') }}"/>
                                            <img v-if="product.base_image" :src="product.base_image"/>
                                        </td>
                                        <td>
                                            @{{ product.name }}
                                        </td>
                                        <td>
                                            @{{ product.formated_price }}
                                        </td>
                                        <td class="last">

                                            <form method="POST" action="{{ route('galaxyclinic.account.services.assign') }}" @submit.prevent="onSubmit">

                                                <div class="page-content">
                                                    @csrf()

                                                    <input type="text" v-validate="'required'" name="product_id" class="control" :value=product.id hidden />

                                                    <button class="btn btn-primary btn-sm theme-btn">Sell yours</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>

                        <li v-if="!services.length && term.length > 2 && !is_searching">
                            {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.no-result-found') }}
                        </li>

                        <li v-if="term.length < 3 && !is_searching">
                            {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.enter-search-term') }}
                        </li>

                        <li v-if="is_searching">
                            {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.searching') }}
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </script>

    <script>

        Vue.component('product-search', {

            template: '#product-search-template',

            data: () => ({
                services: [],

                term: "",

                is_searching: false
            }),

            watch: {
                'term': function(newVal, oldVal) {
                    this.search()
                }
            },

            methods: {
                search () {
                    if (this.term.length > 2) {
                        this_this = this;

                        this.is_searching = true;

                        this.$http.get ("{{ route('galaxyclinic.account.services.search') }}", {params: {query: this.term}})
                            .then (function(response) {
                                console.log("d", response);

                                this_this.services = response.data;

                                this_this.is_searching = false;
                            })

                            .catch (function (error) {
                                console.log("sd", error);
                                this_this.is_searching = false;
                            })
                    }
                },
            }
        });
    </script>

@endpush