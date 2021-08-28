<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class course extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = ['courseId', 'name', 'type', 'details', 'startDate', 'endDate', 'starred'];
}
