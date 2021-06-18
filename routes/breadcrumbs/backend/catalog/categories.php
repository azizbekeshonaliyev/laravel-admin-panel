<?php

Breadcrumbs::for('admin.catalog-categories.index', function ($trail) {
    $trail->push(__('labels.backend.access.catalog-categories.management'), route('admin.catalog-categories.index'));
});

Breadcrumbs::for('admin.catalog-categories.create', function ($trail) {
    $trail->parent('admin.catalog-categories.index');
    $trail->push(__('labels.backend.access.catalog-categories.management'), route('admin.catalog-categories.create'));
});

Breadcrumbs::for('admin.catalog-categories.edit', function ($trail, $id) {
    $trail->parent('admin.catalog-categories.index');
    $trail->push(__('labels.backend.access.catalog-categories.management'), route('admin.catalog-categories.edit', $id));
});
