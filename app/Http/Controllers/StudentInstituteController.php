<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentInstituteController extends Controller
{
    public function GetByInstituteId($instituteId)
    {
        return DB::table('StudentInstitute')->where('instituteId', $instituteId)->get('studentId');
    }
}
