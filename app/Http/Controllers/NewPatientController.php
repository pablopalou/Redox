<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPatientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewPatientController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(NewPatientRequest $request)
    {
        // call the redox api and also save in database
        // see id of patient in my database
        $token = env('TOKEN');
        $organizationOID = env('ORGANIZATION_OID');

        $arguments = $request->validated();
        $user = User::create($arguments);

        $response = Http::acceptJson()->withToken($token)->post('https://api.redoxengine.com/endpoint',
        [
            "Meta" => [
                "DataModel" => "PatientAdmin",
                "EventType" => "NewPatient",
                // You should remove the field below for a production environment.
                "Test" => true,
                "Destinations" => [
                    [
                        // This is your repository destination ID, which will change for a production environment.
                        "ID" => "4c92baef-9795-4989-9b69-3fc775e618e7"
                    ]
                ]
            ],
            "Patient" => [
                "Identifiers" => [
                    [
                        // This ID should be the patient's MRN or primary ID in your system.
                        // The IDType should map from your ID type to the value Redox provides
                        // Typically this is mapping some value like "MR" to this OID.
                        // This OID is linked to the repository and required to associate the patient.
                        "ID" => $user->id,
                        "IDType" => "2.16.840.1.113883.3.6147.458.11386.2.1.2"
                    ]
                ],
                // Populate the fields below as appropriate for your organization, but include as much information as you can. See our documentation for more information.
                "Demographics" => [
                    "FirstName" => $user->first_name,
                    "LastName" => $user->last_name,
                    "DOB" => $user->date_of_birth,
                    "SSN" => $user->ssn,
                    "Sex" => $user->gender
                ],
            ]
        ]
        );

        return $response->json();
    }
}
