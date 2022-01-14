<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('homepage', function ($trail) {
    $trail->push('Home', route('home'));
});