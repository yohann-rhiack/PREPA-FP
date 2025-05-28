<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'school_id'];


    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'cycle_subjects');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    
}
