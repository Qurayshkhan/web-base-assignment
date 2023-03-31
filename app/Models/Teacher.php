<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'collage_id', 'course_id', 'avatar', 'contact', 'location', 'profile_status'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

}
