<?php

namespace App;

use Illuminate\Support\Str;

trait Slug {
    public function slugify( $name ){
        return Str::slug( $name );
    }
}