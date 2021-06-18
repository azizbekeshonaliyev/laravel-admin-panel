@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.catalog-categories.management'))

@section('breadcrumb-links')
    @include('backend.catalog-categories.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.catalog-categories.management') }} <small class="text-muted">{{ __('labels.backend.access.catalog-categories.active') }}</small>
                </h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-success  text-white cursor-pointer" href="{{ route('admin.catalog-categories.create') }}">
                    <i class="fas fa-plus"></i> @lang('menus.backend.access.catalog-categories.create')
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
                                <th>{{ trans('labels.backend.access.catalog-categories.table.name') }}</th>
                                <th>{{ trans('labels.backend.access.catalog-categories.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.catalog-categories.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.catalog-categories.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        {{ $category->active === true  ? __('strings.enabled') : __('strings.disabled') }}
                                    </td>
                                    <td>
                                        {{ $category->createdBy->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $category->created_at }}
                                    </td>
                                    <td class="btn-td">
                                        <div class="btn-group" role="group" aria-label="User Actions">
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" href="{{ route('admin.catalog-categories.edit',$category) }}" title="Edit">
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
                                                            <form action="{{ route('admin.catalog-categories.destroy',$category) }}" method="POST"  name="delete_item" style="display:none">
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
                        @lang('labels.backend.access.catalog-categories.table.total'):  {{ $categories->total() }}
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        {{ $categories->links() }}
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
