@extends('backend.layouts.app')

@section('title', __('labels.backend.access.languages.management') . ' | ' . __('labels.backend.access.languages.create'))

@section('breadcrumb-links')
    @include('backend.languages.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.languages.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.languages.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.languages.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.languages.name')</label>

                        <div class="col-8">
                            <input name="name" id="name" required type="text" class="form-control" placeholder="@lang('validation.attributes.backend.access.languages.name')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="locale" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.languages.locale')</label>

                        <div class="col-8">
                            <input name="locale" id="locale" required type="text" class="form-control" placeholder="@lang('validation.attributes.backend.access.languages.locale')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="rank" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.languages.rank')</label>

                        <div class="col-8">
                            <input name="rank" id="rank" required type="number" class="form-control" placeholder="@lang('validation.attributes.backend.access.languages.rank')">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="active" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.languages.status')</label>

                        <div class="col-md-10">
                            <div class="checkbox d-flex align-items-center">
                                <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1">
                                    <input class="switch-input" type="checkbox" name="active" id="role-1" value="1"><span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
                            </div>
                        </div><!--col-->
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.languages.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
