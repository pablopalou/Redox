<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPatientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class GetPatientController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(GetPatientRequest $request, User $user): UserResource
    {
        return (new UserResource($user));
    }
}
