<?php

use App\Http\Controllers\MobileAuth\Auth;
use App\Http\Controllers\Newborn\Newborn;
use App\Http\Controllers\Profiles\PatientProfile;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Auth::class, 'login']);

Route::prefix('patient-profiles')->group(function(){
    Route::get('/', [PatientProfile::class, 'index']);
    Route::post('/patient-information', [PatientProfile::class, 'getPatientInformation']);
});

//add delivery and new born record
Route::post('/add-delivery-with-newborn-records', [Newborn::class, 'addNewbornRecord']);

//get newborns
Route::post('/get-newborns', [Newborn::class, 'GetNewborns']);
