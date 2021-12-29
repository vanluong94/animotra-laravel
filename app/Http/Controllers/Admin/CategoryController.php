<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class CategoryController extends MangaCollectionController
{
    protected function getCollectionType() {
        return 'category';
    }
}
