<?php

use Illuminate\Support\Facades\Route;
use Library\Adapters\Inbound\Http\HealthController;

Route::get('/health', HealthController::class)->name('health');
