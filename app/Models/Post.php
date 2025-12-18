<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Course;
class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'name', 'email', 'password', 'age', 'course_id'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
