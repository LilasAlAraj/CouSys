<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{

    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'institute';

    //   protected $casts=['isAccepted'=>'boolean'];

}
