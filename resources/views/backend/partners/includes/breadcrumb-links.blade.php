<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('labels.backend.access.partners.all') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.partners.index') }}?active=true">@lang('menus.backend.access.partners.active')</a>
                <a class="dropdown-item" href="{{ route('admin.partners.create') }}">{{ trans('menus.backend.access.partners.create') }}</a>
            </div>
        </div><!--dropdown-->

{{--        <a class="btn" href="#">Static Link</a>--}}
    </div><!--btn-group-->
</li>
