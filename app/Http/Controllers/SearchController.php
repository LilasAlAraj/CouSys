<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SearchController
{

    public function Search(Request $request)
    {
        switch ($request->filter)
        {
            case 'Institute':
                return (new InstituteController())->GetByName($request->name);
                break;

            case 'CourseType':
                return (new Coursecontrol())->GetByType($request->type);
                break;

            case 'CourseName':
                return (new Coursecontrol())->GetByName($request->name);
                break;

            case 'Date':
                return (new Coursecontrol())->GetByDate($request->date);
                break;
                
        }
    }
}
