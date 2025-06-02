<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $a = 5;
    $b = 9;

    dd($a + $b);
});
