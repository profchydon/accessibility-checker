<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    require __DIR__ . '/V1/index.php';
});
