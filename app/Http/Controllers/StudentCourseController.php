<?php

namespace App\Http\Controllers;

use App\Models\student_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentCourseController extends Controller
{


    //*****************************************************//
    //                                                     //
    //***********enrol a new student in a course***********//
    //                                                     //
    //*****************************************************//

    public function enrolStudentInCourse(Request $request)
    {
        if ($this->checkCourseExisting($request->courseID) && $this->checkStudentExisting($request->studentID)) {
            $student_course = new student_course();
            $student_course->courseId = $request->courseId;
            $student_course->studentId = $request->studentId;
            $student_course->time = $request->time;
            if ($student_course->save()) {
                return response()->json(['1' => 'Failed']);
            }
            return response()->json(['Error' => 'Failed']);
        }
        return response()->json(['Error' => 'Failed']);
    }

    private function checkCourseExisting($id)
    {
        $inst = DB::table('institute')->where('courseId', $id)->get()->first();
        if ($inst)
            return false;
        return true;
    }

    private function checkStudentExisting($id)
    {
        $inst = DB::table('institute')->where('instituteId', $id)->get()->first();
        if ($inst)
            return false;
        return true;
    }


}
