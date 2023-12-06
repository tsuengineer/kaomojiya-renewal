<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// トップページ
Breadcrumbs::for('top', function (BreadcrumbTrail $trail) {
    $trail->push(__('title.top_page'), route('top.index'));
});

// 投稿
Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push(__('title.post_facemark'), route('facemarks.create'));
});
