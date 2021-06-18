<?php

Breadcrumbs::for('admin.languages.index', function ($trail) {
    $trail->push(__('labels.backend.access.languages.management'), route('admin.languages.index'));
});

Breadcrumbs::for('admin.languages.create', function ($trail) {
    $trail->parent('admin.languages.index');
    $trail->push(__('labels.backend.access.languages.management'), route('admin.languages.create'));
});

Breadcrumbs::for('admin.languages.edit', function ($trail, $id) {
    $trail->parent('admin.languages.index');
    $trail->push(__('labels.backend.access.languages.management'), route('admin.languages.edit', $id));
});

Breadcrumbs::for('admin.languages.translationsEdit', function ($trail, $id) {
    $trail->parent('admin.languages.index');
    $trail->push(__('labels.backend.access.languages.management'), route('admin.languages.translationsEdit', $id));
});
