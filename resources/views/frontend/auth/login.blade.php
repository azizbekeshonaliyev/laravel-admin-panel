<!DOCTYPE html>
@langrtl
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'AtomLAB admin')">
        <meta name="author" content="@yield('meta_author', 'Azizbek Eshonaliyev')">

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/backend.css')) }}

        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">

        @stack('after-styles')
        <style>
            .hidden {
                display: none !important;
            }
        </style>
    </head>

    <body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">

    <div class="app-body">
        <main class="main">
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @include('includes.partials.messages')
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <div class="card-group">
                                <div class="card p-4">
                                    <div class="card-body">
                                        <form action="{{ route('frontend.auth.login.post') }}" method="POST">
                                            @csrf
                                            <h1>@lang('strings.Login')</h1>
                                            <p class="text-muted">@lang("strings.Sign In to your account")</p>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                </div>
                                                <input type="text" name="username" class="form-control" placeholder="@lang("strings.Username")" autocomplete="username" required>
                                            </div>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                                </div>
                                                <input type="password" name="password" class="form-control" placeholder="@lang("strings.Password")" autocomplete="current-password" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary px-4">@lang("strings.Login")</button>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <button type="button" class="btn btn-link px-0">@lang("strings.Forgot password")?</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--animated-->
            </div>
            <!--container-fluid-->
        </main>
        <!--main-->

        @include('backend.includes.aside')
    </div>
    <!--app-body-->
    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    {!! script(asset('js/backend/common.js')) !!}
    </body>

    </html>

