<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\feedback;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function sendFeedback(Request $request)
    {
        $newFeedback = new feedback;
        $newFeedback->feedbackText = $request->feedbackText;
        $newFeedback->typeOfUser = $request->typeOfUser;
        $newFeedback->isReviewed = false;
        return response()->json($newFeedback->save());
    }

    public function reviewFeedback(Request $request)
    {
        DB::update('update feedback set isReviewed = true where feedbackID = ?',
            [$request->feedbackID]);
        $fb = DB::table('feedback')->where('feedbackID', $request->feedbackID)->get()->first();
        $fb->save();
        return response()->json($fb);

    }
}
