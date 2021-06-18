@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.products.management'))

@section('breadcrumb-links')
    @include('backend.products.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.products.management') }} <small class="text-muted">{{ __('labels.backend.access.products.active') }}</small>
                </h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-success  text-white cursor-pointer" href="{{ route('admin.products.create') }}">
                    <i class="fas fa-plus"></i> @lang('menus.backend.access.products.create')
                </a>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="catalogs-categories" class="table">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.backend.access.products.table.image') }}</th>
                                <th>{{ trans('labels.backend.access.products.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.products.table.meta_title') }}</th>
                                <th>{{ trans('labels.backend.access.products.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.products.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.products.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="/{{ $product->album->image->xs->path ?? '' }}" class="rounded float-left" height="40">

                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->meta_title }}
                                    </td>
                                    <td>
                                        {{ $product->active === true  ? __('strings.enabled') : __('strings.disabled') }}
                                    </td>
                                    <td>
                                        {{ $product->createdBy->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $product->created_at }}
                                    </td>
                                    <td class="btn-td">
                                        <div class="btn-group" role="group" aria-label="User Actions">
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" href="{{ route('admin.products.edit',$product) }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-flat dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="glyphicon glyphicon-option-vertical"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" style="">
                                                    <li>
                                                        <a data-method="delete"
                                                           data-trans-button-cancel="Cancel"
                                                           data-trans-button-confirm="Delete"
                                                           data-trans-title="@lang('strings.Are you sure you want to do this?')"
                                                           style="cursor:pointer;"
                                                           onclick="$(this).find('form').submit();">
                                                            <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i>Delete
                                                            <form action="{{ route('admin.products.destroy',$product) }}" method="POST" name="delete_item" style="display:none">
                                                                @csrf
                                                                @method("DELETE")
                                                            </form>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-6 justify-content-end">
                        @lang('labels.backend.access.products.table.total'):  {{ $products->total() }}
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            <!--col-->
        </div>
        <!--row-->

    </div>
    <!--card-body-->
</div>
<!--card-->
@endsection

@section('pagescript')

@stop
