<?php

use App\Http\Controllers\MobileAuth\Auth;
use App\Http\Controllers\Profiles\PatientProfile;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Auth::class, 'login']);

Route::prefix('patient-profiles')->group(function(){
    Route::get('/', [PatientProfile::class, 'index']);
    Route::post('/patient-information', [PatientProfile::class, 'getPatientInformation']);
});
