<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =['student_id','date','description','payment_category_id','voucher_number',
    'academic_year_id','term_id','exam_id','amount','method'];

    public function category()
    {
        return $this->belongsTo(PaymentCategory::class,'payment_category_id');
    }
}
