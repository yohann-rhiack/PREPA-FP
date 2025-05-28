<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'theme', 
    ];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function summary()
    {
        return $this->hasOne(Summary::class);
    }

}
