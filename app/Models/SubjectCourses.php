<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectCourses extends Model
{
    protected $table = 'subject_courses';
    
    protected $fillable = [

        'subject_id',
        'course_id',
    ];
}
