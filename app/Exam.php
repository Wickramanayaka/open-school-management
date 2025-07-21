<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['code','name','description','term_id','academic_year_id','exam_category_id',
    'start','end','status','has_rank','has_grade_average'];

    public function category()
    {
        return $this->belongsTo(ExamCategory::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function getStatusColorCodeAttribute()
    {
        switch ($this->status) {
            case 'Pending':
                return 'alert-danger';
                break;
            case 'Completed':
                return 'alert-success';
                break;
            case 'Ongoing':
                return 'alert-default';
                break;
        }
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
}
