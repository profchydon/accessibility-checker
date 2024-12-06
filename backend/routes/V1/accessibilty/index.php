<?php

use App\Http\Controllers\V1\AccessibilityController;
use Illuminate\Support\Facades\Route;

Route::controller(AccessibilityController::class)->prefix("/accessibilty")->group(function() {
    Route::post('/analyze', 'analyze');
});
