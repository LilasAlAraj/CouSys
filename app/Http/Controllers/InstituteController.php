<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Accounts_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InstituteController extends Controller
{
    public static function institutelogged(Request $request)
    {
        $institute = DB::table('institute')->where('email', $request->email)->where('password', $request->password)->first();
        if ($institute) {
            if (($institute->isAccepted) == true) {
                return response()->json(['institute_ID' => $institute->instituteId]);
            } else {
                return response()->json(['Error' => 'Your Request is in progress']);
            }
        } else {
            return response()->json(['Error' => 'Password wrong']);
        }
    }

    public static function GetTopRating()
    {
        $institutes = DB::table('institute')
            ->selectRaw('*, votings/numOfVotings as RATING')
            ->orderBy('RATING', 'DESC')
            ->take(5)
            ->get();
        if ($institutes)
            return $institutes;
        return null;
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
            $institute->region = $request->region;
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

    public function CheckExistedBefore($email)
    {
        $inst = DB::table('institute')->where('email', $email)->first();
        if ($inst)
            return false;
        return true;
    }

    public function InstituteProfile($instituteId)
    {
        $inst = DB::table('institute')->where('instituteId', $instituteId)->get()->first();
        return response()->json(['details' => $inst, 'courses' => $this->ViewAllCoursesWithOffer($instituteId)]);
    }

    public function ViewAllCoursesWithOffer($inst_id)
    {
        //  $inst_id=$request->session()->get('institute_session');//get the id of the institute
        $courses = (new Coursecontrol)->GetAllWithOffer($inst_id);
        if ($courses)
            return response()->json(['1' => $courses]);
        return response()->json(['-1' => 'No courses']);
    }

    public function GetNotAccepted()
    {
        return DB::table('institute')->where('isAccepted', false)->get()->all();
    }

    public function GetALL()
    {
        return DB::table('institute')->where('isAccepted', true)->get()->all();
    }

//    public function DismissRequest($instituteId)
//    {
//        DB::table('institute')->find($instituteId)->delete();
//        session::flash('hint', 'Request deleted successfully!');
//        return redirect('/DashBoard');
//    }

    ///////////////////   Courses     ///////////////////

    public function DeleteById($instituteId)
    {
        if (DB::table('institute')->where('instituteId', $instituteId)->delete()) {
            (new Coursecontrol())->DeleteByInsId($instituteId);
            return response()->json(['1' => 'Institute deleted successfully']);
        }
        return response()->json(['Error', 'Sign up failed']);
    }

    public function AcceptRequest($instituteId)
    {
        if (DB::table('institute')->where('instituteId', $instituteId)->update(['isAccepted' => true]))
            return response()->json(['1' => 'Institute added successfully']);
        return response()->json(['-1' => 'Error']);
    }

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

    ///////////////////   Offers     ///////////////////

    public function StarredCourse($courseId)
    {
        return (new Coursecontrol)->Starred($courseId);
    }

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

    ///////////////////   Files     ///////////////////

    public function EditOffer(Request $request)
    {
        return (new OfferController)->Edit($request);
    }

    ///////////////////   search     ///////////////////

    public function ViewAllFiles($courseId)
    {
        $Files = (new FileController)->GetByCourseID($courseId);
        if ($Files)
            return response()->json(['1' => $Files]);
        return response()->json(['-1' => 'No $Files']);
    }

    //// HomePage

    public function Search($word)
    {
        $institutes = DB::table('institute')
            ->where('name', $word)
            ->orWhere('details', 'LIKE', '%' . $word . '%')
            ->orWhere('region', 'LIKE', '%' . $word . '%')
            ->get()->all();
        if ($institutes) {
            return $institutes;
        }
        return null;
    }
}
