<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Coursecontrol extends Controller
{

    public function GetAllWithOffer($inst_id)
    {
        $course = DB::table('course')->where('instituteId', $inst_id)->leftJoin('offer', 'course.courseId', '=', 'offer.courseId')
            ->select('course.*', 'offer.*')->get()->all();
        return $course;
    }

    public function GetOnlyWithOffer($inst_id)
    {
        $course = DB::table('course')->where('instituteId', $inst_id)->join('offer', 'course.courseId', '=', 'offer.courseId')
            ->select('course.*', 'offer.*')->get()->all();
        return $course;
    }

    public function store(Request $request)
    {
        $course = new course;
        //$course->courseId = $request->courseId;
        $course->name = $request->name;
        $course->instituteId = $request->instituteId;
        $course->type = $request->type;
        $course->details = $request->details;
        $course->startDate = $request->startDate;
        $course->endDate = $request->endDate;
        $course->startTime = $request->startTime;
        $course->endTime = $request->endTime;
        $course->starred = $request->starred;
        $Times = serialize($request->times);
        $course->times = $Times;
        $course->save();
        return redirect('/institute_page');
    }

    public function GetByInstId($inst_id)
    {
        return DB::table('course')->where('instituteId', $inst_id)->get()->all();
    }

    public function GetById($id)
    {
        $course = DB::table('course')->find($id)->get();
        return $course;
    }

    public function Edit(Request $request)
    {
        $id = $request->courseId;
        $UpdateData = [
            'name' => $request->name,
            'type' => $request->type,
            'details' => $request->details,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
            'times' => serialize($request->times),
            'starred' => $request->starred
        ];
        DB::table('course')->where('courseId', $id)->update($UpdateData);
        session::flash('hint', 'Data Updated Successfully!');
        return redirect('/institute_page');
    }

    public function Delete($courseId)
    {
        DB::table('courses')->find($courseId)->delete();
        session::flash('hint', 'Course Deleted Successfully!');
        return redirect('/institute_page');
    }

    public function Starred($courseId)
    {
        DB::table('course')->where('courseId', $courseId)->update(['starred' => true]);
        session::flash('hint', 'Course Starred Successfully!');
        return redirect('/institute_page');
    }

}
