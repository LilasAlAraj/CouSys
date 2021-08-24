<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
use App\branch;
use App\course;
use App\Fee;
use Illuminate\Support\Facades\DB;

class Studentcontrol extends Controller
{

    public function StudentLoginForm()
    {
        return view('StudentLogin');
    }

    public function StudentSignUpForm()
    {
        return view('StudentSignUp');
    }


    public function StudenyEditForm($id)
    {
        $students = student::find($id);
        return view('StudentEdit', compact('students'));
    }


    //*****************************************************//
    //                                                     //
    //*******store new student in a storage database*******//
    //                                                     //
    //*****************************************************//

    public function StudentStore(Request $request)
    {
        if ($this->CheckExistedBefore($request->email)) {
            $student = new student;
            $student->fname = $request->fname;
            $student->lName = $request->lName;
            $student->email = $request->email;
            $student->password = $request->password;
            $student->phone = $request->phone;
            $student->save();

            return redirect('StudentLogin');
        } else {
            session::flash('hint', 'This email address is already registered!');
            return redirect('/StudentSignUp')->withInput();
        }

    }

    //**************************************************************//
    //                                                              //
    //*******remove a current student form a storage database*******//
    //                                                              //
    //**************************************************************//

    public function StudentDelete($id)
    {
        $student = student::find($id);
        $student->delete();
        return redirect('StudentLogin');
    }

    //***************************************************************************//
    //                                                                           //
    //******* Update a specified student's details form a storage database*******//
    //                                                                           //
    //***************************************************************************//

    public function update(Request $request, $id)
    {
        $student = student::find($id);
        $student->fname = $request->fname;
        $student->lName = $request->lName;
        $student->email = $request->email;
        $student->password = $request->password;
        $student->phone = $request->phone;
        $student->save();
        return redirect('StudentDetails');
    }




}
