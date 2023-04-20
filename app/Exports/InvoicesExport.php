<?php

namespace App\Exports;

use App\Models\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return ['id', 'invoice_number', 'invoice_Date', 'Due_date', 'product',
            'Amount_collection', 'Amount_Commission', 'Discount', 'Rate_VAT', 'Total', 'Status',
            'note'];
    }

    public function collection()
    {
        return invoices::select('id', 'invoice_number', 'invoice_Date', 'Due_date', 'product',
            'Amount_collection', 'Amount_Commission', 'Discount', 'Rate_VAT', 'Total', 'Status',
            'note', 'Payment_Date')->get();
    }
}
