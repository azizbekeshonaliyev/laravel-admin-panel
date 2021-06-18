@extends('backend.layouts.app')

@section('title', __('labels.backend.access.settings.management') . ' | ' . __('labels.backend.access.settings.create'))

@section('breadcrumb-links')
    @include('backend.settings.includes.breadcrumb-links')
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.settings.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.settings.management') }}
                            <small class="text-muted">{{ __('labels.backend.access.settings.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>
                <div class="row mt-4 mb-4">
                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="col">
                            <div class="card" id="settings-block">
                                <div class="card-header">
                                    @lang('strings.Settings')
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="400">@lang('strings.Key')</th>
                                                <th>@lang("strings.Value")</th>
                                                <th width="200">@lang("strings.Actions")</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,index) in settings">
                                                <td>
                                                    <input :name="'settings[' + index + '][key]'" type="text" class="form-control" :value="item[0]">
                                                </td>
                                                <td>
                                                    <input :name="'settings[' + index + '][value]'" type="text" class="form-control" :value="item[1]">
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" type="button" @click="removeRow(index)"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success" type="button" @click="addRow()"><i class="fa fa-plus"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--col-->
                    </form>
                </div><!--row-->
            </div><!--card-body-->
            @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.settings.index', 'id' => 1 ])
        </div><!--card-->
    {{ Form::close() }}
@endsection

@section('pagescript')
    <script type="text/javascript">
        new Vue({
            el: '#settings-block',
            data: function () {
                return {
                    settings: Object.entries(@json(setting()->all()))
                }
            },
            methods: {
                addRow(){
                    this.settings.push({key: '', value: ''});
                },
                removeRow(index){
                    this.settings.splice(index,1)
                }
            }
        });
    </script>
@endsection
