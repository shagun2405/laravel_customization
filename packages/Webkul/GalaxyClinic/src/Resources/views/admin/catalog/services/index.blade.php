@extends('admin::layouts.content')

@section('page_title')
    {{ __('galaxyclinic::app.catalog.services.title') }}
@stop

@section('content')
    <div class="content" style="height: 100%;">
        <div class="page-header">
            <div class="page-title">
                <h1>{{ __('galaxyclinic::app.catalog.services.title') }}</h1>
            </div>

            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>

                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </div>

                <a href="{{ route('admin.galaxyclinic.catalog.services.create') }}" class="btn btn-lg btn-primary">
                    {{ __('galaxyclinic::app.catalog.services.add-product-btn-title') }}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.galaxyclinic.catalog.services.list.before') !!}

        <div class="page-content">
            <datagrid-plus src="{{ route('admin.galaxyclinic.catalog.services.index') }}"></datagrid-plus>
        </div>

        {!! view_render_event('bagisto.galaxyclinic.catalog.services.list.after') !!}
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('galaxyclinic::app.export.download') }}</h3>

        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => app('Webkul\Admin\DataGrids\ProductDataGrid')])

    <script>
        function reloadPage(getVar, getVal) {
            let url = new URL(window.location.href);

            url.searchParams.set(getVar, getVal);

            window.location.href = url.href;
        }

        function showEditQuantityForm(productId) {
            $(`#product-${productId}-quantity`).hide();

            $(`#edit-product-${productId}-quantity-form-block`).show();
        }

        function cancelEditQuantityForm(productId) {
            $(`#edit-product-${productId}-quantity-form-block`).hide();

            $(`#product-${productId}-quantity`).show();
        }

        function saveEditQuantityForm(updateSource, productId) {
            let quantityFormData = $(`#edit-product-${productId}-quantity-form`).serialize();

            axios
                .post(updateSource, quantityFormData)
                .then(function (response) {
                    let data = response.data;

                    $(`#inventoryErrors${productId}`).text('');

                    $(`#edit-product-${productId}-quantity-form-block`).hide();

                    $(`#product-${productId}-quantity-anchor`).text(data.updatedTotal);

                    $(`#product-${productId}-quantity`).show();
                })
                .catch(function ({ response }) {
                    let { data } = response;

                    $(`#inventoryErrors${productId}`).text(data.message);
                });
        }
    </script>
@endpush
