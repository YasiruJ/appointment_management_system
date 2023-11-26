<?php

namespace App\Http\Controllers\Api\v1;

use App\Contracts\AppointmentInterface;
use App\Contracts\InvoiceInterface;
use App\Contracts\PatientInterface;
use App\Contracts\ReceiptInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ResponseData;


class PatientController extends Controller
{

    public $patient;
    public $appointment;
    public $invoice;
    public $receipt;

    function __construct(PatientInterface $patient,AppointmentInterface $appointment, InvoiceInterface $invoice, ReceiptInterface $receipt)
    {
        $this->patient = $patient;
        $this->appointment = $appointment;
        $this->invoice = $invoice;
        $this->receipt = $receipt;
    }

    public function getPatient($id)
    {

        $patient_data = collect();

        //patient data
        $patient =  $this->patient->getPatientbyId($id);
        $patient_id = $id;
        $patient_created_date = date('Y-m-d', (strtotime(date($patient->created_at))));


        //appointments data
        $first_appointment = $this->appointment->getFirstAppointmentbyId($id);

        if(!$first_appointment) {
            $first_appointment_id = null;
            $first_appointment_date = null;
        }

        //invoice data
        $invoice = $this->invoice->getAllInvoiceIds($id);
        $first_invoice = $this->invoice->getFirstInvoicebyId($id);
        $first_invoice_date = date('Y-m-d', (strtotime(date($first_invoice->created_at))));


        if(!$invoice) {
            $invoice = [];
            $first_invoice_date = null;
        }

        //receipt data
        $total_receipts = $this->receipt->getTotalReceipts($id);
        $receipts = $this->receipt->getAllReceiptsIds($id);
        $first_receipt = $this->receipt->getFirstInvoicebyId($id);
        $first_receipt_date = date('Y-m-d', (strtotime(date($first_receipt->receipt_created_date))));

        if(!$receipts) {
            $invoice = [];
            $total_receipts = null;
            $first_receipt_date = null;
        }


            $patient_data['patient_id'] = $patient_id;
            $patient_data['first_appointment_id'] = $first_appointment_id;
            $patient_data['invoice'] = $invoice;
            $patient_data['total_receipts'] = $total_receipts;
            $patient_data['receipts'] = $receipts;
            $patient_data['first_receipt_date'] = $first_receipt_date;
            $patient_data['first_invoice_date'] = $first_invoice_date;
            $patient_data['first_appointment_date'] = $first_appointment_date;
            $patient_data['patient_created_date'] = $patient_created_date;

        return new ResponseData($patient_data);
    }
}
