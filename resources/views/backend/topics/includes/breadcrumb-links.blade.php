<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('labels.backend.access.topics.all') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.topics.index') }}?active=true">@lang('menus.backend.access.topics.active')</a>
                <a class="dropdown-item" href="{{ route('admin.topics.create') }}">{{ trans('menus.backend.access.topics.create') }}</a>
            </div>
        </div><!--dropdown-->

{{--        <a class="btn" href="#">Static Link</a>--}}
    </div><!--btn-group-->
</li>
