<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Exception;
use Illuminate\Http\Request;

class PatientProfile extends Controller
{
    public function index(){
        $patients = Profiles::get();

        return response()->json([
            'patients' => $patients
        ], 200);
    }

    public function getPatientInformation(Request $request){
        try{
            $patient = Profiles::where('id', $request->id)->first();

            if(!$patient){
                throw new Exception('Patient is not found');
            }

            return response()->json([
                'patient' => $patient
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something went wrong while fetching data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
