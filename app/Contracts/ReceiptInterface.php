<?php

namespace App\Contracts;

interface ReceiptInterface {

    public function getTotalReceipts($id);

    public function getAllReceiptsIds($id);

    public function getFirstInvoicebyId($id);
}
