@extends('backend.layouts.app')

@section('title', __('labels.backend.access.languages.management') . ' | ' . __('labels.backend.access.languages.edit'))

@section('breadcrumb-links')
    @include('backend.languages.includes.breadcrumb-links')
@endsection

@section('content')
        <div class="card" id="translations-vue">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <h4 class="card-title mb-0">
                            {{ __('labels.backend.access.languages.management') }}
                            <small class="text-muted">{{ __('labels.backend.access.languages.edit') }}</small>
                        </h4>
                    </div><!--col-->
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="Search" class="col-sm-2 col-form-label">@lang('strings.Search')</label>
                            <div class="col-sm-10">
                                <input type="text" v-model="search" class="form-control" id="Search">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <h4 class="float-right">
                            {{ $language->name }} ({{ strtoupper($language->locale) }})
                        </h4>
                    </div>
                </div><!--row-->
                <hr>
                <div class="row mt-4 mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('admin.translations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="locale" value="{{$language->locale}}">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="key" class="col-2 col-form-label">@lang('strings.Key')</label>
                                                <div class="col-10">
                                                    <input name="key" id="key" required type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label for="key" class="col-2 col-form-label">@lang('strings.Value')</label>
                                                <div class="col-10">
                                                    <textarea name="value" class="form-control" rows="1" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"> @lang('strings.Create')</i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="30">@lang('strings.Key')</th>
                                <th scope="col">@lang('strings.Value')</th>
                                <th scope="col">@lang('strings.Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) in filtered_translations" @dblclick="onEdit(item)" class="cursor-pointer">
                                    <td v-html="item.key"></td>
                                    <td>
                                        <template v-if="editing.id === item.id">
                                            <textarea v-model="editing.value" class="form-control" cols="100" rows="3"></textarea>
                                        </template>
                                        <p v-else v-html="item.value"></p>
                                    </td>
                                    <td>
                                        <template v-if="editing.id === item.id">
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Save" @click="save()">
                                                <i class="fas fa-save"></i>
                                            </button>
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" href="#" title="Undo" @click="undo()">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" @click="onEdit(item)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden">
                </div><!--row-->
            </div><!--card-body-->
        </div><!--card-->
@endsection

@section('pagescript')
    <script type="text/javascript">
        new Vue({
            el: '#translations-vue',
            data: function () {
                return {
                    translations: [],
                    langId: {{ $language->id }},
                    editing: {},
                    search: '',
                }
            },
            computed:{
                filtered_translations: function (){
                    var search = this.search;
                    return this.translations.filter(function (obj) { return obj.value.indexOf(search) !== -1; });
                }
            },
            mounted(){
                this.loadTranslations();
            },
            methods: {
                onEdit(item){
                    this.editing = JSON.parse( JSON.stringify(item));
                },
                undo(){
                  this.editing = {}
                },
                save(){
                    axios.post(`/admin/language/translation/${this.editing.id}/update`,{
                        key : this.editing.key,
                        value : this.editing.value,
                        _token: "{{ csrf_token() }}"
                    })
                    .then(res => {
                        this.undo();
                        this.loadTranslations()
                    })
                    .catch(err => {
                        console.log(err)
                    })
                },
                loadTranslations(){
                    axios.get(`/admin/language/${this.langId}/getTranslations`)
                    .then(res => {
                        this.translations = res.data ? res.data.translations : [];
                    })
                    .catch(err=>{
                        console.log(err)
                    })
                }
            }
        });
    </script>
@endsection
