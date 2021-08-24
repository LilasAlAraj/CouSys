<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    use HasFactory;
    protected $table = 'offer';
    protected $fillable = [
        'offerId', 'courseId', 'details', 'startDateTime', 'endDateTime'
    ];
}
