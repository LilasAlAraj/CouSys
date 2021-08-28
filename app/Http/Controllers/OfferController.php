<?php

namespace App\Http\Controllers;

use App\Models\offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OfferController extends Controller
{

    /*
 "courseId" : "2",
 "startDateTime": "2020-6-15 12:12:12",
 "endDateTime": "2020-8-15  12:12:12",
 "offerDetails": "available for 2 weeks"
     */
    public function store(Request $request)
    {
        $offer = new offer;
        $offer->courseId = $request->courseId;
        $offer->offerDetails = $request->offerDetails;
        $offer->startDateTime = $request->startDateTime;
        $offer->endDateTime = $request->endDateTime;
        if ($offer->save())
            return response()->json(['1' => 'Offer added successfully']);
        return response()->json(['Error' => 'Added failed']);
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
        if (DB::table('offer')->where('offerId', $offerId)->delete())
            return response()->json(['1' => 'offer deleted successfully']);
        return response()->json(['Error' => 'Deleted failed']);
    }

    public function Edit(Request $request)
    {
        $offerId = $request->offerId;
        $UpdateData = [
            'offerDetails' => $request->offerDetails,
            'startDateTime' => $request->startDateTime,
            'endDateTime' => $request->endDateTime
        ];
        if (DB::table('offer')->where('offerId', $offerId)->update($UpdateData)) {
            return response()->json(['1' => 'Offer updated successfully']);
        }
        return response()->json(['Error' => 'Updated failed']);
    }
}
