<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\student;
use App\branch;
use App\course;
use App\Fee;
use Illuminate\Support\Facades\DB;

class Studentcontrol extends Controller
{

    //*****************************************************//
    //                                                     //
    //*******store new student in a storage database*******//
    //                                                     //
    //*****************************************************//


    public function CheckExistedBefore($email)
    {
        $std = DB::table('student')->where('email', $email)->get()->first();
        if ($std)
            return false;
        return true;
    }

    public function storeStudentRecord(Request $request)
    {
        if ($this->CheckExistedBefore($request->email)) {
            $student = new student;
            $student->fname = $request->fname;
            $student->lName = $request->lName;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;
            $student->save();

            return response()->json($student);
        } else {

            return response()->json('this account is already registered');
        }

    }

    //**************************************************************//
    //                                                              //
    //*******remove a current student form a storage database*******//
    //                                                              //
    //**************************************************************//

    public function deleteStudentRecord(Request $request)
    {
        $student = DB::table('student')->where('studentId', $request->id);
        return response()->json($student->delete());

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


}
