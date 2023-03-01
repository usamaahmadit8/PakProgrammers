<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'city',
        'first_name',
        'last_name',
        'phone',
        'qualification',
        'course',
    ];
}
