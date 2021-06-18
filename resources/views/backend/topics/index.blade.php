@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.access.topics.management'))

@section('breadcrumb-links')
    @include('backend.topics.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.access.topics.management') }} <small class="text-muted">{{ __('labels.backend.access.topics.active') }}</small>
                </h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a class="btn btn-success  text-white cursor-pointer" href="{{ route('admin.topics.create') }}">
                    <i class="fas fa-plus"></i> @lang('menus.backend.access.topics.create')
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
                                <th>{{ trans('labels.backend.access.topics.table.image') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.title') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.published_at') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.meta_title') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.status') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.createdby') }}</th>
                                <th>{{ trans('labels.backend.access.topics.table.createdat') }}</th>
                                <th>{{ trans('labels.general.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>
                                        <img src="/{{ $topic->album->image->xs->path ?? '' }}" class="rounded float-left" height="40">

                                    </td>
                                    <td>
                                        {{ $topic->title }}
                                    </td>
                                    <td>
                                        {{ $topic->published_at }}
                                    </td>
                                    <td>
                                        {{ $topic->meta_title }}
                                    </td>
                                    <td>
                                        {{ $topic->active === true  ? __('strings.enabled') : __('strings.disabled') }}
                                    </td>
                                    <td>
                                        {{ $topic->createdBy->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $topic->created_at }}
                                    </td>
                                    <td class="btn-td">
                                        <div class="btn-group" role="group" aria-label="User Actions">
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" href="{{ route('admin.topics.edit',$topic) }}" title="Edit">
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
                                                            <form action="{{ route('admin.topics.destroy',$topic) }}" method="POST" name="delete_item" style="display:none">
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
                        @lang('labels.backend.access.topics.table.total'):  {{ $topics->total() }}
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        {{ $topics->links() }}
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
