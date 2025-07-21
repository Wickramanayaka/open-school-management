<?php

namespace ProactiveAnts\Parents;

use Illuminate\Database\Eloquent\Model;

class ParentsAppPayment extends Model
{
    protected $fillable = [
        'payment_date', 'amount', 'parents_app_user_id','expiry_date', 'method', 'canceled','status','invoice_number','charge_total',
        'gross_amount', 'trx_ref_number', 'trx_date_time', 'message', 'code', 'ipg_status','resp_token'
    ];

    public function scopeConfirmed($query)
    {
        return $query->where('status',1);
    }
}
