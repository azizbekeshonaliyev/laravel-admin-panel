<?php

Breadcrumbs::for('admin.products.index', function ($trail) {
    $trail->push(__('labels.backend.access.products.management'), route('admin.products.index'));
});

Breadcrumbs::for('admin.products.create', function ($trail) {
    $trail->parent('admin.products.index');
    $trail->push(__('labels.backend.access.products.management'), route('admin.products.create'));
});

Breadcrumbs::for('admin.products.edit', function ($trail, $id) {
    $trail->parent('admin.products.index');
    $trail->push(__('labels.backend.access.products.management'), route('admin.products.edit', $id));
});
