<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// トップページ
Breadcrumbs::for('top', function (BreadcrumbTrail $trail) {
    $trail->push(__('title.top_page'), route('top.index'));
});
