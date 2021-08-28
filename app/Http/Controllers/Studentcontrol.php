<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use App\Models\Accounts_log;
use Illuminate\Support\Facades\DB;

class Studentcontrol extends Controller
{

    public static function studentLogged(Request $request)
    {
        $std = DB::table('student')->where('email', $request->email)->where('password', $request->password)->first();
        if ($std) {
            return response()->json(['student_ID' => $std->studentId]);
        } else {
            return response()->json(['Error' => 'Password wrong']);
        }
    }

    //*****************************************************//
    //                                                     //
    //*******store new student in a storage database*******//
    //                                                     //
    //*****************************************************//

    public function storeStudentRecord(Request $request)
    {
        if ($this->CheckExistedBefore($request->email)) {
            $student = new student;
            $student->fname = $request->fname;
            $student->lName = $request->lName;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;

            $accountLog = new Accounts_Log;
            $accountLog->email = $request->email;
            $accountLog->typeOfUser = 'Student';

            if ($student->save() && $accountLog->save()) {
                return response()->json(['student_Id' => $student->studentId]);
            }
            return response()->json(['Error', 'Sign up failed']);
        } else {
            return response()->json(['Error', 'this account is already registered']);
        }

    }

    public function CheckExistedBefore($email)
    {
        $std = DB::table('student')->where('email', $email)->get()->first();
        if ($std)
            return false;
        return true;
    }

    //**************************************************************//
    //                                                              //
    //*******remove a current student form a storage database*******//
    //                                                              //
    //**************************************************************//

    public function deleteStudentRecord(Request $request)
    {
        $student = DB::table('student')->where('studentId', $request->id);

        if ($student->delete()) {
            return response()->json(['1' => 'Deleted successfully']);
        }
        return response()->json(['Error' => 'Deleted failed']);
    }

    //***************************************************************************//
    //                                                                           //
    //******* Update a specified student's details form a storage database*******//
    //                                                                           //
    //***************************************************************************//

    public function editStudentRecord(Request $request)
    {
        return response()->json(DB::update('update student set fname = ? , lname = ?, email = ?, password = ?, phone=?
                where studentId = ?', [$request->fname, $request->lname, $request->email,
            $request->password, $request->phone, $request->id]));
    }

    public function DeleteById($studentId)
    {
        if (DB::table('student')->where('studentId', $studentId)->delete()) {
            return response()->json(['1' => 'Deleted successfully']);
        }
        return response()->json(['Error' => 'Deleted failed']);
    }

    public function GetALL()
    {
        return DB::table('student')->get()->all();
    }
}
