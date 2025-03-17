<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['name', 'description'];
}

class Cycle extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['name', 'description'];
}

class Subject extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title', 'description'];
}

class Course extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title', 'content'];
}

class Chapter extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title', 'content', 'course_id', 'parent_id'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

class Summary extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['content', 'chapter_id'];
    
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}

class Type extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title'];
}

class Test extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title', 'type_id', 'time'];
    
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}

class Quiz extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['question', 'tag'];
}

class Answer extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['content', 'tag'];
}

class Plan extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['title', 'description', 'price', 'course_id'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

class User extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['fname', 'lname', 'email', 'phone', 'password'];
    
    protected $hidden = ['password'];
}

class Attempt extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['start_time', 'end_time', 'mark', 'test_id', 'user_id'];
    
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

class Subscription extends Model
{
    use HasFactory;
    use Softdeletes;
    protected $fillable = ['start_date', 'end_date', 'status', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
