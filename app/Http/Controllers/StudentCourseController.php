<?php

namespace App\Http\Controllers;

use App\student_course;
use Illuminate\Support\Facades\DB;

class StudentCourseController extends Controller
{
    public function AddNewRecord($request)
    {
        $student_course = new student_course();
        $student_course->courseId = $request->courseId;
        $student_course->studentId = $request->studentId;
        $student_course->time = $request->time;
        $student_course->save();
    }


}
