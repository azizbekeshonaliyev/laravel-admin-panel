<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @foreach(cache()->get('languages') as $lang)
        @if($lang != app()->getLocale())
            <small><a href="{{ '/lang/'.$lang['locale'] }}" class="dropdown-item pt-1 pb-1">{{ $lang['name'] }} ({{ strtoupper($lang->locale) }})</a></small>
        @endif
    @endforeach
</div>
