@extends('shop::customers.account.index')

@section('page_title')
    {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.title') }}
@endsection

@section('page-detail-wrapper')
    <div class="account-layout">

        <div class="account-head">
            <span class="account-heading">
                {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.title') }}
            </span>

            <div class="account-action">
                <a href="{{ route('galaxyclinic.account.services.search') }}" class="btn btn-primary">
                    {{ __('galaxyclinic::app.shop.clinic.account.catalog.services.create') }}
                </a>
            </div>

            <div class="horizontal-rule"></div>
        </div>

        {!! view_render_event('galaxyclinic.clinic.account.catalog.services.list.before') !!}

        <div class="account-items-list">
            <div class="account-table-content">

                <datagrid-plus src="{{ route('galaxyclinic.account.services.index') }}"></datagrid-plus>

            </div>
        </div>

        {!! view_render_event('galaxyclinic.clinic.account.catalog.services.list.after') !!}

    </div>

@endsection