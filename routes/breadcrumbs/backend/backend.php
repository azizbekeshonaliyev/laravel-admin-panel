<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';
require __DIR__.'/pages/page.php';
require __DIR__.'/auth/permission.php';
require __DIR__.'/catalog/categories.php';
require __DIR__.'/catalog/products.php';
require __DIR__.'/language/lang.php';
require __DIR__.'/partner/partner.php';
require __DIR__.'/setting/setting.php';
require __DIR__.'/certificate/certificate.php';
require __DIR__.'/topic/topic.php';
require __DIR__.'/order/order.php';
