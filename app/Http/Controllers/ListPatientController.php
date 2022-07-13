<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;

class ListPatientController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request): UserResourceCollection
    {
        $users = User::all();
        return  new UserResourceCollection($users);
    }
}
