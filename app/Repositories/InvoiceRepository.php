<?php

namespace App\Repositories;

use App\Contracts\InvoiceInterface;
use App\Models\Invoice;

class InvoiceRepository implements InvoiceInterface {

    public function getAllInvoiceIds($id) {

        return Invoice::where('external_patient_id',$id)->pluck('invoice_no');
    }

    public function getFirstInvoicebyId($id) {

        return Invoice::where('external_patient_id',$id)->first();
    }
}

