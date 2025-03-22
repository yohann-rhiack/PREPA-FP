<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
