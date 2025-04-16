<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'course_id', 
        'summary_description', 
    ];

    // Relation avec le chapitre
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    // Relation inverse avec le cours
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
