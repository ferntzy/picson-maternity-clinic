<?php

namespace App\Http\Controllers\Newborn;

use App\Http\Controllers\Controller;
use App\Models\Deliveries;
use App\Models\NewbornRecordData;
use App\Models\Newborns;
use App\Models\Profiles;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Newborn extends Controller
{
    public function addNewbornRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $delivery = Deliveries::create([
                'time_of_delivery' => $request->input('time_of_delivery'),
                'type_of_delivery' => $request->input('delivery_type'),
                'profile_id'       => $request->input('patient_id'),
            ]);

            foreach ($request->newborns as $newbornData) {
                $profile = Profiles::create([
                    'firstname'  => $newbornData['firstname']  ?? null,
                    'middlename' => $newbornData['middlename'] ?? null,
                    'lastname'   => $newbornData['lastname']   ?? null,
                    'address'    => $newbornData['address']    ?? null,
                    'sex'        => $newbornData['sex']        ?? null,
                    'role'       => 'newborn',
                ]);

                $newborn = Newborns::create([
                    'delivery_id'            => $delivery->id,
                    'profile_id'             => $profile->id,
                    'newborn_screening_done' => Carbon::today(),
                ]);

                $assessments = $newbornData['assessments'] ?? [];

                if (!empty($assessments)) {
                    $rows = array_map(fn($a) => [
                        'newborn_id'      => $newborn->id,
                        'assessment_type' => $a['assessment_type'],
                        'item'            => $a['item'],
                        'value'           => $a['value'],
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ], $assessments);

                    NewbornRecordData::insert($rows);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Delivery record saved successfully.',
            ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Something went wrong while processing data!',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}