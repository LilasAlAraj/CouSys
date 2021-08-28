<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsLogController extends Controller
{


    public function LoginProcess(Request $request)
    {
        $account = DB::table('accountLog')->where('email', $request->email)->get()->first();
        if ($account) {
            if ($account->typeOfUser == 'Student') {
                return Studentcontrol::studentLogged($request);
            } else if ($account->typeOfUser == 'Institute') {
                return InstituteController::institutelogged($request);
            } else if ($account->typeOfUser == 'Admin') {
                return Admincontrol::AdminLogged($request);
            }

        } else {
            return response()->json(['Error' => 'Email Not Found']);

        }
    }

    public function HomePage()
    {
        $institute = InstituteController::GetTopRating();
        $course = Coursecontrol::GetRandomCourses();
        return response()->json(['institute' => $institute, 'course' => $course]);
    }
}
