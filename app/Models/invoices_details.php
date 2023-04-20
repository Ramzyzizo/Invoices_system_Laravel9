<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_Invoice',
        'invoice_number',
        'product',
        'section_id','status_id', 'Status','Payment_Date','note','user',
    ];

    public function user_name(){
        return $this->belongsTo('App\Models\User','user');
    }
}
