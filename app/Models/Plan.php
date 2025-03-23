<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
