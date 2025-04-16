<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'tag', 'test_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'quiz_id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
