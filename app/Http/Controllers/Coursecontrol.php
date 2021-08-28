<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Coursecontrol extends Controller
{

    public static function GetRandomCourses()
    {
        $courses = DB::table('course')
            ->leftJoin('offer', 'course.courseId', '=', 'offer.courseId')
            ->inRandomOrder()
            ->select('course.*', 'offer.offerId', 'offer.offerDetails', 'offer.startDateTime', 'offer.endDateTime')
            ->take(15)
            ->get();
        if ($courses)
            return $courses;
        return null;
    }

    public function GetAllWithOffer($inst_id)
    {
        $course = DB::table('course')
            ->where('instituteId', $inst_id)
            ->leftJoin('offer', 'course.courseId', '=', 'offer.courseId')
            ->select('course.*', 'offer.offerId', 'offer.offerDetails', 'offer.startDateTime', 'offer.endDateTime')
            ->get()->all();
        return $course;
    }

    public function GetOnlyWithOffer($inst_id)
    {
        $course = DB::table('course')
            ->where('instituteId', $inst_id)
            ->join('offer', 'course.courseId', '=', 'offer.courseId')
            ->select('course.*', 'offer.offerId', 'offer.offerDetails', 'offer.startDateTime', 'offer.endDateTime')
            ->get()->all();
        return $course;
    }

    public function store(Request $request)
    {
        $course = new course;
        $course->name = $request->name;
        $course->instituteId = $request->instituteId;
        $course->type = $request->type;
        $course->details = $request->details;
        $course->startDate = $request->startDate;
        $course->endDate = $request->endDate;
        $course->starred = $request->starred;
        $course->cost = $request->cost;
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
            'starred' => $request->starred,
            'cost' => $request->cost
        ];
        if (DB::table('course')->where('courseId', $id)->update($UpdateData)) {
            return response()->json(['1' => 'Course updated successfully']);
        }
        return response()->json(['Error', 'Updated failed']);
    }

    public function Delete($courseId)
    {
        if (DB::table('course')->where('courseId', $courseId)->delete()) {
            return response()->json(['1' => 'Deleted successfully']);
        }
        return response()->json(['Error', 'Deleted failed']);
    }

    public function Starred($courseId)
    {
        if (DB::table('course')->where('courseId', $courseId)->update(['starred' => true]))
            return response()->json(['1' => 'Course starred successfully']);
        return response()->json(['-1' => 'Error']);
    }


    //// Search and Filter

    public function DeleteByInsId($instId)
    {
        DB::table('course')->where('instituteId', $instId)->delete();
    }

    public function Search($word)
    {
        $courses = DB::table('course')
            ->where('type', $word)
            ->orWhere('name', $word)
            ->orwhere('details', 'LIKE', '%' . $word . '%')
            ->get()->all();
        if ($courses) {
            return $courses;
        }
        return null;
    }

    //// HomePage

    public function Filter(Request $request)
    {
        $coursesQuery = DB::table('course');
        if ($request->has('Region')) {
            $coursesQuery->join('institute', 'course.instituteId', '=', 'institute.instituteId')
                ->where('institute.region', 'LIKE', '%' . $request->Region . '%');
        }
        if ($request->has("name")) {
            $coursesQuery->where('name', $request->name);
        }
        if ($request->has("type")) {
            $coursesQuery->where('type', $request->type);
        }
        if ($request->has("Date")) {
            $coursesQuery->where('startDate', '>', $request->Date);
        }
        if ($request->has("Cost")) {
            $coursesQuery->where('cost', '<=', $request->Cost);
        }
        $courses = $coursesQuery->get()->all();
        if ($courses)
            return $courses;
        return null;
    }
}
