<?php

use App\Models\User;
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

// 検索
Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push(__('title.search'), route('search.index'));
});

// ユーザ一覧
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push(__('title.users'), route('users.index'));
});

// ユーザ個別
Breadcrumbs::for('user', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('users');
    $trail->push($user->name, route('users.show', ['slug' => $user->slug]));
});

// エラー
Breadcrumbs::for('errors.204', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push('204', route('errors.204'));
});
Breadcrumbs::for('errors.403', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push('403', route('errors.403'));
});
Breadcrumbs::for('errors.404', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push('404', route('errors.404'));
});
Breadcrumbs::for('errors.500', function (BreadcrumbTrail $trail) {
    $trail->parent('top');
    $trail->push('500', route('errors.500'));
});
