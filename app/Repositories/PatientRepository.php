<?php

namespace App\Repositories;

use App\Contracts\PatientInterface;
use App\Models\Patient;

class PatientRepository implements PatientInterface {

    public function getPatientbyId($id) {

        return Patient::where('external_patient_id',$id)->first();
    }
}
