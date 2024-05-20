<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render("Dashboard/Index");
});

require __DIR__ . '/auth.php';
