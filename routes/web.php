<?php

use App\Http\Controllers\RouterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::resource("routers", RouterController::class);

require __DIR__ . '/auth.php';
