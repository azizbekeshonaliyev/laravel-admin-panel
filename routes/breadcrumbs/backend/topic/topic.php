<?php

Breadcrumbs::for('admin.topics.index', function ($trail) {
    $trail->push(__('labels.backend.access.topics.management'), route('admin.topics.index'));
});

Breadcrumbs::for('admin.topics.create', function ($trail) {
    $trail->parent('admin.topics.index');
    $trail->push(__('labels.backend.access.topics.management'), route('admin.topics.create'));
});

Breadcrumbs::for('admin.topics.edit', function ($trail, $id) {
    $trail->parent('admin.topics.index');
    $trail->push(__('labels.backend.access.topics.management'), route('admin.topics.edit', $id));
});
