<?php

namespace App\Http\Controllers;

use App\Models\student_course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\EnrollmentCourseRequest;

class EnrollmentCourseRequestController extends Controller
{
    public function GetAllRequest($inst_id)
    {
        $request = DB::table('enrollmentCourseRequest')
            ->join('course', 'course.courseId', '=', 'request.courseId')
            ->where('course.instituteId', $inst_id)
            ->join('student', 'student.studentId', '=', 'request.studentId')
            ->select('student.*', 'request.*', 'course.*')
            ->get()->all();
        return $request;
    }

    public function addRequest(Request $request)
    {
        $newRequest = new  EnrollmentCourseRequest;
        $newRequest->courseId = $request->courseId;
        $newRequest->studentId = $request->studentId;
        $newRequest->time = $request->time;
        return response()->json($newRequest->save());
    }

    public function AcceptRequest(Request $request)
    {
        $_ecr_ = DB::table('enrollmentCourseRequest')->where('requestId', $request->requestId);
        $ecr = $_ecr_->get()->first();
        $sc = new student_course;
        $sc->courseId = $ecr->courseId;
        $sc->studentId = $ecr->studentId;
        $sc->time = $ecr->time;

        if ($sc->save()) {

            $sc->update(['created_at' => $ecr->created_at]);
            $_ecr_->delete();
            return response()->json(['1' => 'Request accepted']);
        }
        return response()->json(['-1' => 'Error']);
    }

    public function DismissRequest(Request $request)
    {
        if (DB::table('enrollmentCourseRequest')->where('requestId', $request->requestId)->delete())
            return response()->json(['1' => 'Request Deleted!']);
        return response()->json(['-1' => 'Error']);
    }

}
