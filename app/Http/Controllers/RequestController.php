<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestController extends Controller
{
    public function GetAllRequest($inst_id)
    {
        $request = DB::table('request')
            ->join('course','course.courseId' ,'=','request.courseId')
            ->where('course.instituteId',$inst_id)
            ->join('student','student.studentId','=','request.studentId')
            ->select('student.*','request.*','course.*')
            ->get()->all();
        return $request;
    }

    public function AcceptRequest($requestId)
    {
        $request = DB::table('request')->find($requestId)->get();
        (new StudentCourseController)->AddNewRecord($request);
        DB::table('request')->find($requestId)->delete();
    }

    public function DismissRequest($requestId)
    {
        DB::table('request')->find($requestId)->delete();
    }

}
