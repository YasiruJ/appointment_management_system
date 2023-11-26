<?php

namespace App\Contracts;

interface InvoiceInterface {

    public function getAllInvoiceIds($id);

    public function getFirstInvoicebyId($id);
}
