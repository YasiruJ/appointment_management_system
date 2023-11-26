<?php

namespace App\Repositories;

use App\Contracts\AppointmentInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentInterface {

    public function getFirstAppointmentbyId($id) {

        return Appointment::where('external_patient_id',$id)->first();

    }
}
