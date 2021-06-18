@extends('backend.layouts.app')

@section('title', __('labels.backend.access.orders.management') . ' | ' . __('labels.backend.access.orders.edit'))

@section('breadcrumb-links')
    @include('backend.orders.includes.breadcrumb-links')
@endsection

@section('content')

    {{ Form::model($order, ['route' => ['admin.orders.update', $order], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.orders.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.orders.edit') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.orders.name')</label>

                        <div class="col-8">
                            <input name="name" id="name" required type="text" class="form-control" value="{{ $order->name }}" placeholder="@lang('validation.attributes.backend.access.orders.name')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.orders.phone')</label>

                        <div class="col-8">
                            <input name="phone" id="phone" required type="text" class="form-control"  value="{{ $order->phone }}" placeholder="@lang('validation.attributes.backend.access.orders.phone')">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="organization" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.orders.organization')</label>

                        <div class="col-8">
                            <input name="organization" id="organization" required type="text" class="form-control" value="{{ $order->organization }}" placeholder="@lang('validation.attributes.backend.access.orders.organization')">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.orders.status')</label>

                        <div class="col-8">
                            <select class="form-control" name="status">
                                <option value="{{ \Domain\Order\Entities\Order::STATUS_NEW }}" @if($order->status == \Domain\Order\Entities\Order::STATUS_NEW) selected @endif>@lang('strings.new')</option>
                                <option value="{{ \Domain\Order\Entities\Order::STATUS_COMPLETED }}" @if($order->status == \Domain\Order\Entities\Order::STATUS_COMPLETED) selected @endif>@lang('strings.completed')</option>
                                <option value="{{ \Domain\Order\Entities\Order::STATUS_CANCELED }}" @if($order->status == \Domain\Order\Entities\Order::STATUS_CANCELED) selected @endif>@lang('strings.canceled')</option>
                            </select>
                        </div><!--col-->
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.orders.index', 'id' => $order->id  ])
    </div><!--card-->
    {{ Form::close() }}
@endsection
