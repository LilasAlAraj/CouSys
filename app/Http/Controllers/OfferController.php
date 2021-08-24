<?php

namespace App\Http\Controllers;

use App\offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{

    public function store(Request $request)
    {
        $offer = new offer;
        // $offer->offerId=$request->offerId;
        $offer->courseId = $request->courseId;
        $offer->details = $request->details;
        $offer->startDateTime = $request->startDateTime;
        $offer->endDateTime = $request->endDateTime;
        $offer->save();
        return redirect('/institute_page');
    }

    public function GetById($id)
    {
        return DB::table('offer')->find($id)->get();
    }

    public function GetByInstId($inst_id)
    {
        return DB::table('offer')->where('instituteId', $inst_id)->get()->all();//get all courses for this institute
    }

    public function Delete($offerId)
    {
        DB::table('offer')->find($offerId)->delete();
        session::flash('hint', 'Offer Deleted Successfully!');
        return redirect('/institute_page');
    }

    public function Edit(Request $request)
    {
        $offerId = $request->offerId;
        $UpdateData = [
            //'courseId'=>$request->courseId,
            'details' => $request->details,
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime
        ];
        DB::table('offer')->where('offerId', $offerId)->update($UpdateData);
        session::flash('hint', 'Data Updated Successfully!');
        return redirect('/institute_page');
    }
}
