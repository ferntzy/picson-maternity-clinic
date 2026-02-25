<?php

use App\Http\Controllers\MobileAuth\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Auth::class, 'login']);