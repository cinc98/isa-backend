<?php

namespace App\Services;
use App\Services\IClinicService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

use App\Clinic;

class ClinicService implements IClinicService
{
    public function searchClinic($name)
    {
        $clinics = null;
        //Redis::get('clinics');
        if($clinics == null)
        {
            if($name != null)
                $clinics = Clinic::where('name', 'like', '%'.$name.'%')->with('appointmentTypes')->get();
            else
                $clinics = Clinic::with('appointmentTypes')->get();
            Redis::set('clinics', $clinics);
            return $clinics;
        }
        else
            return $clinics;
    }

    public function addClinic($clinic)
    {
        $clinic = Clinic::create($clinic);
        $clinics = Clinic::all();
        Redis::set('clinics',$clinics);

        return $clinic;
    }
    public function deleteClinic($clinic)
    {

    }
    public function updateClinic($clinic,$values)
    {

    }


}