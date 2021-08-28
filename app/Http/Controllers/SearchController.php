<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController
{
    public function G_Search(Request $request)
    {
        $courses = (new Coursecontrol())->Search($request->word);
        $institutes = (new InstituteController())->Search($request->word);
        if ($courses != null && $institutes != null)
            return response()->json(['courses' => $courses, 'institutes' => $institutes]);
    }

    public function Filter(Request $request)
    {
        $courses = (new Coursecontrol())->Filter($request);
        if ($courses != null) {
            return response()->json(['courses' => $courses]);
        }
        return response()->json(['Error' => 'No Result']);
    }
}
