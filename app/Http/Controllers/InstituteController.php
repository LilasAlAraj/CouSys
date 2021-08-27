<?php


namespace App\Http\Controllers;


use App\Models\Institute;
use App\Models\Accounts_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InstituteController extends Controller
{

    public function CheckExistedBefore($email)
    {
        $inst = DB::table('institute')->where('email', $email)->first();
        if ($inst)
            return false;
        return true;
    }

    public function InstituteSignUp(Request $request)
    {
        if ($this->CheckExistedBefore($request->email)) {
            $institute = new Institute();
            $institute->name = $request->name;
            $institute->email = $request->email;;
            $institute->phone = $request->phone;
            $institute->password = $request->password;
            $institute->city = $request->city;
            $institute->street = $request->street;
            $institute->details = $request->details;
            $institute->openTime = $request->openTime;
            $institute->closeTime = $request->closeTime;
            $institute->votings = 0;
            $institute->numOfVotings = 0;
            $institute->isAccepted = false;

            $accountLog = new Accounts_Log;
            $accountLog->email = $request->email;
            $accountLog->typeOfUser = 'Institute';

            if ($institute->save() && $accountLog->save())
                return response()->json(['1' => 'Your request is in progress']);
            return response()->json(['-1' => 'Error']);
        } else {
            return response()->json(['-1' => 'This institute has been registered before!']);
        }
    }


    public static function institutelogged(Request $request)
    {
        $institute = DB::table('institute')->where('email', $request->email)->where('password', $request->password)->first();
        if ($institute) {
            if (($institute->isAccepted) == true) {
                return response()->json(['institute_ID' => $institute->instituteId]);
            } else {
                return response()->json(['-1' => 'Your Request is in progress']);
            }
        } else {
            return response()->json(['-1' => 'Email or Password not match']);
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
        if (DB::table('institute')->where('instituteId', $instituteId)->delete()) {
            (new Coursecontrol())->DeleteByInsId($instituteId);
            return response()->json(['1' => 'Institute deleted successfully']);
        }
        return response()->json(['-1' => 'Error']);
    }

    public function AcceptRequest($instituteId)
    {
        if (DB::table('institute')->where('instituteId', $instituteId)->update(['isAccepted' => true]))
            return response()->json(['1' => 'Institute added successfully']);
        return response()->json(['-1' => 'Error']);
    }

    public function DismissRequest($instituteId)
    {
        DB::table('institute')->find($instituteId)->delete();
        session::flash('hint', 'Request deleted successfully!');
        return redirect('/DashBoard');
    }

    ///////////////////   Courses     ///////////////////

    public function ViewAllCoursesWithOffer($inst_id)
    {
        //  $inst_id=$request->session()->get('institute_session');//get the id of the institute
        $courses = (new Coursecontrol)->GetAllWithOffer($inst_id);//get all courses for this institute
        //return view('ViewAllCourses',$courses);
        if ($courses)
            return response()->json(['1' => $courses]);
        return response()->json(['-1' => 'No courses']);
    }

//    public function ViewAllCourses($inst_id)
//    {
//        //$inst_id=$request->session()->get('institute_session');//get the id of the institute
//        $courses =  (new Coursecontrol)->GetByInstId($inst_id);//get all courses for this institute
//        return view('ViewAllCourses',$courses);
//    }


    public function AddNewCourse(Request $request)
    {
        return (new Coursecontrol)->store($request);
    }

    public function DeleteCourse($courseId)
    {
        return (new Coursecontrol)->Delete($courseId);
    }

    public function EditCourse(Request $request)
    {
        return (new Coursecontrol)->Edit($request);
    }

    public function StarredCourse($courseId)
    {
        return (new Coursecontrol)->Starred($courseId);
    }

    ///////////////////   Offers     ///////////////////

    public function ViewAllOffers($inst_id)
    {
        $offers = (new Coursecontrol)->GetOnlyWithOffer($inst_id);
        if ($offers)
            return response()->json(['1' => $offers]);
        return response()->json(['-1' => 'No offers']);
    }

    public function AddNewOffer(Request $request)
    {
        return (new OfferController)->store($request);
    }

    public function DeleteOffer($offerId)
    {
        return (new OfferController)->Delete($offerId);
    }


    public function EditOffer(Request $request)
    {
        return (new OfferController)->Edit($request);
    }

    ///////////////////   Files     ///////////////////

    public function ViewAllFiles($courseId)
    {
        $Files = (new FileController)->GetByCourseID($courseId);
        if ($Files)
            return response()->json(['1' => $Files]);
        return response()->json(['-1' => 'No $Files']);
    }

    ///////////////////   Request     ///////////////////

//    public function ViewAllRequests(Request $request)
//    {
//        $instituteId=$request->session()->get('institute_session');
//        $Requests = (new RequestController)->GetAllRequest($instituteId);
//        return view('ViewAllRequests',$Requests);
//    }
//
//    public function AcceptStudent($requestId)
//    {
//        (new RequestController)->AcceptRequest($requestId);
//    }
//
//    public function DismissStudent($requestId)
//    {
//        (new RequestController)->DismissRequest($requestId);
    //   }

    ///////////////////   search     ///////////////////

    public function GetByName($name)
    {
        $institutes = DB::table('institute')->where('name', $name)->get()->all();
        if ($institutes) {
            return response()->json(['1' => $institutes]);
        }
        return response()->json(['-1' => 'No Result']);
    }

}
