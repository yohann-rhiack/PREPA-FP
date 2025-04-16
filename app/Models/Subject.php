<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    //Définir la relation avec le modèle Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'subject_courses');
    }
}
