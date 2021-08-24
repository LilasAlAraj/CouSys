<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admincontrol extends Controller
{
    public function AdminLoginForm()
    {
        return view('AdminLoginPage');
    }

    public function AdminLogged(Request $request)
    {
        $admin = DB::table('admin')->where('username', $request->username)->where('password', $request->password)->get();
        if ($admin) {
            $request->session()->put('admin_session', $admin[0]['id']);
            return redirect('/DashBord');
        } else {
            session::flash('hint', 'Email and Password not match');
            return redirect('/AdminLogin')->withInput();
        }
    }


    public function AddNewAdminForm()
    {
        return view('AddNewAdmin');
    }

    public function AddNewAdmin(Request $request)
    {
        $adminId = DB::table('admin')->where('username', $request->username)->where('password', $request->password)->get();
        if ($adminId) {
            session::flash('hint', 'Username has been registered before!');
            return redirect('/AddNewAdmin')->withInput();
        } else {
            $admin = new admin();
            $admin->username = $request->username;
            $admin->password = $request->password;
            $admin->save();
            session::flash('hint', 'New admin is added successfully');
            return redirect('/DashBoard');
        }
    }

    public function ViewAllRequest()
    {
        $institutes = (new InstituteController)->GetNotAccepted();
        if ($institutes == null) {
            session::flash('hint', 'There is no requests!');
            return redirect('/DashBoard');
        } else {
            return view('ViewAllRequest', $institutes);
        }
    }

    public function ViewAllInstitute()
    {
        $institutes = (new InstituteController)->GetALL();
        if ($institutes == null) {
            session::flash('hint', 'There is no institutes!');
            return redirect('/DashBoard');
        } else {
            return view('ViewAllInstitute', $institutes);
        }
    }

    public function DeleteInstitute($instituteId)
    {
        (new InstituteController())->DeleteById($instituteId);
    }

    public function AcceptRequest($instituteId)
    {
        (new InstituteController())->AcceptRequest($instituteId);
    }

    public function DismissRequest($instituteId)
    {
        (new InstituteController())->DismissRequest($instituteId);
    }

    ///////////////////////////////////////////////////////////////


    public function ViewAllStudents()
    {

    }

    public function DeleteStudent($studentId)
    {

    }

    ///////////////////////////////////////////////////////////////

    public function ViewInstituteFeedback()
    {

    }

    public function ViewStudentFeedback()
    {

    }

}
