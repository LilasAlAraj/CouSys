<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Studentcontrol;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\Admincontrol;
use function PHPUnit\Framework\returnArgument;

class AccountsLogController extends Controller
{

    public function LoginProcess(Request $request)
    {
        $account = DB::table('accountLog')->where('email', $request->email)->get()->first();
        if ($account) {
            if ($account->typeOfUser == 'Student') {

                return Studentcontrol::studentLogged($request);
            } else if ($account->typeOfUser == 'Institute') {

                return InstituteController::institutelogged($request);
            } else if ($account->typeOfUser == 'Institute') {
                return Admincontrol::AdminLogged($request);
            }

        } else {
            return response()->json(['-1' => 'Email Not Found']);

        }
    }
}
