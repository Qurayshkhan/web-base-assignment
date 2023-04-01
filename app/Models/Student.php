<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['user_id', 'teacher_id', 'avatar', 'collage_id' ,'degree_title', 'roll_number', 'contact', 'location', 'profile_status'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function collage(){
        return $this->belongsTo(Collage::class);
    }

}
