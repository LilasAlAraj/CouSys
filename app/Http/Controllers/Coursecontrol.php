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
            ->select('course.*', 'offer.offerId', 'offer.offerDetails', 'offer.startDateTime', 'offer.endDateTime')->get()->all();
        return $course;
    }

    public function GetOnlyWithOffer($inst_id)
    {
        $course = DB::table('course')->where('instituteId', $inst_id)->join('offer', 'course.courseId', '=', 'offer.courseId')
            ->select('course.*', 'offer.offerId', 'offer.offerDetails', 'offer.startDateTime', 'offer.endDateTime')->get()->all();
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
        $course->starred = $request->starred;
        $course->times = $request->times;
        if ($course->save())
            return response()->json(['1' => 'Course added successfully']);
        return response()->json(['-1' => 'Error']);
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

    /*
 "name" : "JAVA_OOP",
 "courseId" : "9",
 "type": "Programming",
 "startDate": "2020-6-15",
 "endDate": "2020-8-15",
 "times": "2:30-3:30",
 "starred": "1",
 "details": "Tocontact : 09999999999"
    */
    public function Edit(Request $request)
    {
        $id = $request->courseId;
        $UpdateData = [
            'name' => $request->name,
            'type' => $request->type,
            'details' => $request->details,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'times' => $request->times,
            'starred' => $request->starred
        ];
        if (DB::table('course')->where('courseId', $id)->update($UpdateData)) {
            return response()->json(['1' => 'Course updated successfully']);
        }
//        session::flash('hint', 'Data Updated Successfully!');
//        return redirect('/institute_page');
        return response()->json(['-1' => 'Error']);
    }

    public function Delete($courseId)
    {
        if (DB::table('course')->where('courseId', $courseId)->delete())
            return response()->json(['1' => 'Course deleted successfully']);
//        session::flash('hint', 'Course Deleted Successfully!');
//        return redirect('/institute_page');
        return response()->json(['-1' => 'Error']);
    }

    public function Starred($courseId)
    {
        if (DB::table('course')->where('courseId', $courseId)->update(['starred' => true]))
            return response()->json(['1' => 'Course starred successfully']);
//        session::flash('hint', 'Course Starred Successfully!');
//        return redirect('/institute_page');
        return response()->json(['-1' => 'Error']);
    }

    public function DeleteByInsId($instId)
    {
        DB::table('course')->where('instituteId', $instId)->delete();
    }


    //// Search Filters

    public function GetByType($type)
    {
        $courses = DB::table('course')->where('type', $type)->get()->all();
        if ($courses) {
            return response()->json(['1' => $courses]);
        }
        return response()->json(['-1' => 'No Result']);
    }

    public function GetByName($name)
    {
        $courses = DB::table('course')->where('name', $name)->get()->all();
        if ($courses) {
            return response()->json(['1' => $courses]);
        }
        return response()->json(['-1' => 'No Result']);
    }


    public function GetByDate($Date)
    {
        $courses = DB::table('course')->where('startDate', '>', $Date)->get()->all();
        if ($courses) {
            return response()->json(['1' => $courses]);
        }
        return response()->json(['-1' => 'No Result']);
    }
}
