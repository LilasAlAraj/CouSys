<?php


namespace App\Http\Controllers;
use App\Http\Controllers\EnrollmentCourseRequestController;
use App\Models\Institute;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InstituteController extends Controller
{
    public function InstituteLoginForm()
    {
        return view('InstituteLogin');
    }

    public function InstituteSignUpForm()
    {
        return view('InstituteSignUp');
    }

    public function LogOut(Request $request)
    {
        $request->session()->invalidate();
    }

    public function InstituteSignUp(Request $request)
    {
        if ($this->CheckExistedBefore($request->email)) {
            $institute = new Institute();
            $institute->instituteId = $request->instituteId;
            $institute->name = $request->name;
            $institute->email = $request->email;
            $institute->phone = $request->phone;
            $institute->password = $request->password;
            $institute->city = $request->city;
            $institute->street = $request->street;
            $institute->details = $request->details;
            $institute->openTime = $request->openTime;
            $institute->closeTime = $request->closeTime;
            $institute->votings = $request->votings;
            $institute->numOfVotings = $request->numOfVotings;
            $institute->isAccepted = false;
            $institute->save();
            /////////////////////////======   HINT   ======////////////////////
            return view('Request');
        } else {
            session::flash('hint', 'This institute has been registered before!');
            return redirect('/InstituteSignUp')->withInput();
        }
    }

    public function CheckExistedBefore($email)
    {
        $inst = DB::table('institute')->where('email', $email)->get()->first();
        if ($inst)
            return false;
        return true;
    }

    public function institutelogged(Request $request)
    {
        $institute = DB::table('institute')->where('email', $request->email)->where('password', $request->password);
        if ($institute && $institute->get('isAccepted') == true) {
            //$request->session()->put('institute_session', $institute[0]['id']);

            return response()->json($institute->get('instituteId'));
        } else {
            return response()->json('Email or Password not match');
        }
    }

    public function GetNotAccepted()
    {
        $institutes = DB::table('institute')->where('isAccepted', false)->get()->all();
        return $institutes;
    }

    public function GetALL()
    {
        $institutes = DB::table('institute')->where('isAccepted', true)->get()->all();
        return $institutes;
    }

    public function DeleteById($instituteId)
    {
        DB::table('institute')->find($instituteId)->delete();
        session::flash('hint', 'Institute deleted successfully!');
        return redirect('/DashBoard');
    }

    public function AcceptRequest($instituteId)
    {
        DB::table('institute')->find($instituteId)->update(['isAccepted' => true]);
        session::flash('hint', 'Institute added successfully to the system!');
        return redirect('/DashBoard');
    }

    public function DismissRequest($instituteId)
    {
        DB::table('institute')->find($instituteId)->delete();
        session::flash('hint', 'Request deleted successfully!');
        return redirect('/DashBoard');
    }

    ///////////////////   Courses     ///////////////////

    public function ViewAllCoursesWithOffer(Request $request)
    {
        $inst_id = $request->session()->get('institute_session');//get the id of the institute
        $courses = (new Coursecontrol)->GetAllWithOffer($inst_id);//get all courses for this institute
        return view('ViewAllCourses', $courses);
    }

    public function ViewAllCourses(Request $request)
    {
        $inst_id = $request->session()->get('institute_session');//get the id of the institute
        $courses = (new Coursecontrol)->GetByInstId($inst_id);//get all courses for this institute
        return view('ViewAllCourses', $courses);
    }

    public function AddNewCourseForm()
    {
        return view('AddNewCourseForm');
    }

    public function AddNewCourse(Request $request)
    {
        (new Coursecontrol)->store($request);
    }

    public function DeleteCourse($courseId)
    {
        (new Coursecontrol)->Delete($courseId);
    }

    public function EditCourseForm()
    {
        return view('EditCourseForm');
    }

    public function EditCourse(Request $request)
    {
        (new Coursecontrol)->Edit($request);
    }

    public function StarredCourse($courseId)
    {
        (new Coursecontrol)->Starred($courseId);
    }

    ///////////////////   Offers     ///////////////////

    public function ViewAllOffers(Request $request)
    {
        $inst_id = $request->session()->get('institute_session');//get the id of the institute
        $offers = (new Coursecontrol)->GetOnlyWithOffer($inst_id);
        return view('ViewAllOffers', $offers);
    }

    public function AddNewOfferForm()
    {
        return view('AddNewOfferForm');
    }

    public function AddNewOffer(Request $request)
    {
        (new OfferController)->store($request);
    }

    public function DeleteOffer($offerId)
    {
        (new OfferController)->Delete($offerId);
    }

    public function EditOfferForm()
    {
        return view('EditOfferForm');
    }

    public function EditOffer(Request $request)
    {
        (new OfferController)->Edit($request);
    }

    ///////////////////   Files     ///////////////////

    public function ViewAllFiles($courseId)
    {
        $Files = (new FileController)->GetByCourseID($courseId);
        return view('ViewAllFiles', $Files);
    }



    ///////////////////   Feedback     ///////////////////



}
