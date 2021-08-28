<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'http://127.0.0.1:8000/*'
//        'http://127.0.0.1:8000/InstituteSignUp','http://127.0.0.1:8000/InstituteLogin','http://127.0.0.1:8000/AddNewCourse',
//        'http://127.0.0.1:8000/RemoveCourse/','http://127.0.0.1:8000/EditCourse','http://127.0.0.1:8000/StarredCourse/',
//        'http://127.0.0.1:8000/ViewAllCourses','http://127.0.0.1:8000/AddNewOffer','http://127.0.0.1:8000/RemoveOffer/',
//        'http://127.0.0.1:8000/EditOffer','http://127.0.0.1:8000/ViewAllOffers/','http://127.0.0.1:8000/ViewFiles/',
//        'http://127.0.0.1:8000/AdminLogin','http://127.0.0.1:8000/AddNewAdmin','http://127.0.0.1:8000/ViewAllRequests',
//        'http://127.0.0.1:8000/ViewAllInstitute','http://127.0.0.1:8000/DeleteInstitute',
    ];
}
