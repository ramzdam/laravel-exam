<?php
use Illuminate\Support\Str;

if (! function_exists('generateUniqueString')) {
    function generateUniqueString($model, $column, $length = 5)
    {
        do {
            $uniqueString = Str::random($length);
        } while ($model::where($column, $uniqueString)->exists());

        return $uniqueString;
    }
}
