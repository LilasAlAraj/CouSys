<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentCourseRequest extends Model
{
    use HasFactory;
    protected $table = 'enrollmentCourseRequest';
    protected $guarded = ['requestId'];
}
