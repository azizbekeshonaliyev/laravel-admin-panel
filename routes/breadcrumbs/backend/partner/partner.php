<?php

Breadcrumbs::for('admin.partners.index', function ($trail) {
    $trail->push(__('labels.backend.access.partners.management'), route('admin.partners.index'));
});

Breadcrumbs::for('admin.partners.create', function ($trail) {
    $trail->parent('admin.partners.index');
    $trail->push(__('labels.backend.access.partners.management'), route('admin.partners.create'));
});

Breadcrumbs::for('admin.partners.edit', function ($trail, $id) {
    $trail->parent('admin.partners.index');
    $trail->push(__('labels.backend.access.partners.management'), route('admin.partners.edit', $id));
});
