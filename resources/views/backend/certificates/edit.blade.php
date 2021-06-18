@extends('backend.layouts.app')

@section('title', __('labels.backend.access.certificates.management') . ' | ' . __('labels.backend.access.certificates.edit'))

@section('breadcrumb-links')
    @include('backend.certificates.includes.breadcrumb-links')
@endsection

@section('content')
    <form action="{{ route('admin.certificates.update',$certificate) }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
        @csrf
        @method("PATCH")
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.certificates.management') }}
                            <small class="text-muted">{{ __('labels.backend.access.certificates.create') }}</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab-1" role="tablist">
                                <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">@lang('strings.General')</a>
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
                                                <label for="name_{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.certificates.name')</label>
                                                <div class="col-md-10">
                                                    <input name="translations[{{$language->locale}}][name]" id="name_{{$language->locale}}" type="text" class="form-control" value="{{ $certificate->translate($language->locale)->name ?? '' }}">
                                                </div><!--col-->
                                            </div><!--form-group-->
                                            <div class="form-group row">
                                                <label for="desc_{{$language->locale}}" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.certificates.desc')</label>
                                                <div class="col-md-10">
                                                    <textarea name="translations[{{$language->locale}}][desc]" id="desc_{{$language->locale}}" rows="6" class="form-control tinyText">{{ $certificate->translate($language->locale)->desc ?? '' }}</textarea>
                                                </div><!--col-->
                                            </div><!--form-group-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-data" role="tabpanel" aria-labelledby="nav-data-tab">
                                <div class="form-group row">
                                    <label for="rank" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.certificates.rank')</label>
                                    <div class="col-md-10">
                                        <input type="number"  name="rank" class="form-control" id="rank"  value="{{ $certificate->rank }}">
                                    </div>
                                    <!--col-->
                                </div>
                                <!--form-group-->

                                <div class="form-group row">
                                    <label for="active" class="col-sm-2 col-form-label">@lang('validation.attributes.backend.access.certificates.status')</label>
                                    <div class="col-md-10">
                                        <div class="checkbox d-flex align-items-center">
                                            <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1">
                                                <input class="switch-input" type="checkbox" name="active" id="role-1" value="1" @if($certificate->active) checked @endif>
                                                <span class="switch-slider" data-checked="on" data-unchecked="off"></span>
                                            </label>
                                        </div>
                                    </div><!--col-->
                                </div>
                            </div>
                            <div class="tab-pane" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
                                <div class="card">
                                    <div class="card-header">
                                        Image
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <img src="/{{ $certificate->album->image->path ?? '' }}" width="200" class="img-thumbnail">
                                                </td>
                                                <td class="ml-2">
                                                    <input name="cover_image" type="file" class="form-control-file">
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
            @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.certificates.index', 'id' => $certificate->id ])
        </div><!--card-->
    </form>
@endsection


@section('pagescript')
    <script type="text/javascript">
        tinymce.init({
            selector: '.tinyText'
        });
    </script>
@endsection
