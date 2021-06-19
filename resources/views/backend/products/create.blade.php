@extends('backend.layouts.app')

@section('title', __('labels.backend.access.products.management') . ' | ' . __('labels.backend.access.products.create'))

@section('breadcrumb-links')
    @include('backend.products.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::open(['route' => 'admin.products.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.backend.access.products.management') }}
                        <small class="text-muted">{{ __('labels.backend.access.products.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4 mb-4">
                <div class="col">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab-1" role="tablist">
                            <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">@lang("strings.General")</a>
                            <a class="nav-item nav-link" id="nav-data-tab" data-toggle="tab" href="#nav-data" role="tab" aria-controls="nav-data" aria-selected="false">@lang('strings.Data')</a>
                            <a class="nav-item nav-link" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab" aria-controls="nav-image" aria-selected="false">@lang('strings.Image')</a>
                        </div>
                    </nav>
                    <div class="tab-content border-left-0 border-bottom-0 border-right-0" id="nav-tabContent-1">
                        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab-in" role="tablist">
                                    @foreach(cache()->get('languages') as $language)
                                        <a class="nav-item nav-link @if($loop->first) active @endif" id="nav-name-{{$language->locale}}-tab" data-toggle="tab" href="#nav-name-{{$language->locale}}" role="tab" aria-controls="nav-name-{{$language->locale}}" aria-selected="{{ $loop->first === 1 }}"> {{$language->name }}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content border-left-0 border-bottom-0 border-right-0" id="nav-tabContent-2">
                                @foreach(cache()->get('languages') as $language)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-name-{{$language->locale}}" role="tabpanel" aria-labelledby="nav-name-{{$language->locale}}-tab">
                                        <div class="form-group row">
                                            <label for="name_{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.name')</label>
                                            <div class="col-md-10">
                                                <input name="translations[{{$language->locale}}][name]" id="name_{{$language->locale}}" type="text" class="form-control" placeholder="@lang('validation.attributes.backend.access.products.name')">
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <label for="desc_{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.desc')</label>
                                            <div class="col-md-10">
                                                <textarea name="translations[{{$language->locale}}][desc]" id="desc_{{$language->locale}}" rows="6" class="form-control tinyText" placeholder="@lang('validation.attributes.backend.access.products.desc')"></textarea>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <label for="meta_title{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.meta_title')</label>
                                            <div class="col-md-10">
                                                <input name="translations[{{$language->locale}}][meta_title]" id="meta_title{{$language->locale}}" type="text" class="form-control" placeholder="@lang('validation.attributes.backend.access.products.meta_title')">
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <label for="meta_description{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.meta_description')</label>
                                            <div class="col-md-10">
                                                <textarea name="translations[{{$language->locale}}][meta_description]" id="meta_description{{$language->locale}}" rows="6" class="form-control" placeholder="@lang('validation.attributes.backend.access.products.meta_description')"></textarea>
                                            </div><!--col-->
                                        </div><!--form-group-->

                                        <div class="form-group row">
                                            <label for="meta_keywords{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.meta_keywords')</label>
                                            <div class="col-md-10">
                                                <textarea name="translations[{{$language->locale}}][meta_keywords]" id="meta_keywords{{$language->locale}}" rows="6" class="form-control" placeholder="@lang('validation.attributes.backend.access.products.meta_keywords')"></textarea>
                                            </div><!--col-->
                                        </div><!--form-group-->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab">
                            <div class="form-group row">
                                <label for="catalog_category_id" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.category')</label>
                                <div class="col-md-10">
                                    <select name="catalog_category_id" class="form-control box-size select2-term" style="width: 100%" id="catalog_category_id">
                                        <option value="">Select</option>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--col-->
                            </div>
                            <!--form-group-->

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.price')</label>
                                <div class="col-md-10">
                                    <input type="number" name="price" class="form-control" id="price">
                                </div>
                                <!--col-->
                            </div>
                            <!--form-group-->

                            <div class="form-group row">
                                <label for="in_stock" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.in_stock')</label>
                                <div class="col-md-10">
                                    <input type="number"  name="in_stock" class="form-control" id="in_stock">
                                </div>
                                <!--col-->
                            </div>
                            <!--form-group-->

                            <div class="form-group row">
                                <label for="rank" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.rank')</label>
                                <div class="col-md-10">
                                    <input type="number"  name="rank" class="form-control" id="rank">
                                </div>
                                <!--col-->
                            </div>
                            <!--form-group-->

                            <div class="form-group row">
                                <label for="active" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.products.status')</label>
                                <div class="col-md-10">
                                    <div class="checkbox d-flex align-items-center">
                                        <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1">
                                            <input class="switch-input" type="checkbox" name="active" id="role-1" value="1" checked>
                                            <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                                        </label>
                                    </div>
                                </div><!--col-->
                            </div>
                        </div>
                        <div class="tab-pane" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
                            <div class="card">
                                <div class="card-header">
                                    @lang('strings.Image')
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="/vendor/bek96/album/images/default.jpg" width="200" class="img-thumbnail">
                                                </td>
                                                <td class="ml-2">
                                                    <input name="cover_image" type="file" class="form-control-file">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-header">
                                    @lang('strings.Additional Images')
                                </div>
                                <div class="card-body" id="additional-images">
                                    <table class="table table-align-middle">
                                        <tbody>
                                            <tr v-for="(item,index) in images">
                                                <td>
                                                    <input :name="'images[' + index + ']'" type="file" class="form-control-file">
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" type="button" @click="removeRow(index)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <tr class="mt-2">
                                            <td>
                                                <button class="btn btn-success" type="button" @click="addRow()">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
        @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.products.index' ])
    </div><!--card-->
    {{ Form::close() }}
@endsection

@section('pagescript')
    <script type="text/javascript">
        new Vue({
            el: '#additional-images',
            data: function () {
                return {
                    images: []
                }
            },
            methods: {
                addRow(){
                    this.images.push({});
                },
                removeRow(index){
                    this.images.splice(index,1)
                }
            }
        });
    </script>
@endsection
