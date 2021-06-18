<?php

Breadcrumbs::for('admin.certificates.index', function ($trail) {
    $trail->push(__('labels.backend.access.certificates.management'), route('admin.certificates.index'));
});

Breadcrumbs::for('admin.certificates.create', function ($trail) {
    $trail->parent('admin.certificates.index');
    $trail->push(__('labels.backend.access.certificates.management'), route('admin.certificates.create'));
});

Breadcrumbs::for('admin.certificates.edit', function ($trail, $id) {
    $trail->parent('admin.certificates.index');
    $trail->push(__('labels.backend.access.certificates.management'), route('admin.certificates.edit', $id));
});
