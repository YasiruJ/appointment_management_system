<?php

namespace App\Repositories;

use App\Contracts\ReceiptInterface;
use App\Models\Receipt;

class ReceiptRepository implements ReceiptInterface {

    public function getTotalReceipts($id) {

        return Receipt::where('external_patient_id',$id)->sum('amount');
    }

    public function getAllReceiptsIds($id) {

        return Receipt::where('external_patient_id',$id)->pluck('receipt_id');
    }

    public function getFirstInvoicebyId($id) {

        return Receipt::where('external_patient_id',$id)->first();
    }
}

