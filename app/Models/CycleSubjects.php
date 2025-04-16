<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CycleSubjects extends Model
{
    protected $table = 'cycle_subjects';
    
    protected $fillable = [
        'cycle_id',
        'subject_id',
    ];
}
