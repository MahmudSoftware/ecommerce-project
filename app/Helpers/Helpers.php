<?php


namespace App\Helpers;

use Illuminate\Support\Str;
use App\Models\Category;


class helpers{

    public static function generateSlug($name)
    {
        $slug = Str::slug($name);
        return $slug;
    }
}
