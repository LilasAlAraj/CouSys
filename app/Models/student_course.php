<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_course extends Model
{
    use HasFactory;
    protected $table = 'student_course';
    protected $guarded = ['s_cId'];
}
