<?php

namespace App\Http\Controllers;

use App\admin;
use App\Models\Accounts_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admincontrol extends Controller
{

    public static function AdminLogged(Request $request)
    {
        $admin = DB::table('admin')->where('email', $request->username)->where('password', $request->password)->first();
        if ($admin) {
            return response()->json(['admin_ID' => $admin->adminId]);
        } else {
            return response()->json(['-1' => 'Email or Password not match']);
        }
    }

    public function AddNewAdmin(Request $request)
    {
        $adminId = DB::table('admin')->where('email', $request->email)->where('password', $request->password)->first();
        if ($adminId) {
            return response()->json(['-1' => 'Username added before']);
        } else {
            $admin = new admin();
            $admin->email = $request->email;
            $admin->username = $request->username;
            $admin->password = $request->password;

            $accountLog = new Accounts_Log;
            $accountLog->email = $request->email;
            $accountLog->typeOfUser = 'Admin';
            if ($accountLog->save() && $admin->save())
                return response()->json(['1' => 'New admin added successfully']);
            return response()->json(['-1' => 'Error']);
        }
    }

    public function ViewAllRequest()
    {
        $institutes = (new InstituteController)->GetNotAccepted();
        if ($institutes == null) {
            return response()->json(['-1' => 'No Request']);
        } else {
            return response()->json(['1' => $institutes]);
        }
    }

    public function ViewAllInstitute()
    {
        $institutes = (new InstituteController)->GetALL();
        if ($institutes == null) {
            return response()->json(['-1' => 'There is no institutes!']);
        } else {
            return response()->json(['1' => $institutes]);
        }
    }


    public function DeleteInstitute($instituteId)
    {
        return (new InstituteController())->DeleteById($instituteId);
    }

    public function AcceptRequest($instituteId)
    {
        return (new InstituteController())->AcceptRequest($instituteId);
    }

    public function DismissRequest($instituteId)
    {
        (new InstituteController())->DismissRequest($instituteId);
    }

    ///////////////////////////////////////////////////////////////

    public function ViewAllStudent()
    {
        $students = (new Studentcontrol())->GetALL();
        if ($students == null) {
            return response()->json(['-1' => 'There is no institutes!']);
        } else {
            return response()->json(['1' => $students]);
        }
    }

    public function DeleteStudent($studentId)
    {
        return (new Studentcontrol())->DeleteById($studentId);
    }

    ///////////////////////////////////////////////////////////////

    public function ViewInstituteFeedback()
    {

    }

    public function ViewStudentFeedback()
    {

    }

}
