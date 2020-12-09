<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use \App\Models\Payment;
class Student extends Model
{
    use HasFactory;

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function slot(){
        return $this->belongsTo(slot::class);
    }
}
