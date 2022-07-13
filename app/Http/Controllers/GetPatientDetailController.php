<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetPatientDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user): JsonResponse
    {
        //call to the redox api and get the info of the patient
        // first we should make the call to RLS to locate the patient in the organizations
        // to make this, we first find the identifiers of the patient and then the organizations.
        // dd($request->getContent());
        $response = Http::acceptJson()->withToken('0b86eddc-a33c-4b88-89d5-6b798c7b485b')->post('https://api.redoxengine.com/endpoint',
        // [
        //     'FirstName' => $user->first_name,
        //     'LastName' => $user->last_name,
        //     'DOB' => $user->date_of_birth,
        //     'Sex' => ucfirst($user->gender),
        // ]
        // [$request->getContent()]
        [
            "Meta" => [
                "Extensions" => [
                    "sender-organization-id" => [
                        "url" => "https://api.redoxengine.com/extensions/sender-organization-id",
                        // The value below should be the OID for your organization. If you have multiple levels, it helps to be specific, but you can also use your top-level OID.
                        "string" => "2.16.840.1.113883.3.6147.458.11339.2.1.1"
                    ],
                    "user-id" => [
                        "url" => "https://api.redoxengine.com/extensions/user-id",
                        // The value below should change per query and should be a human-readable ID for the user (typically this is a name, not an actual ID).
                        "string" => "pepitoGonzalez"
                    ],
                    "user-role" => [
                        "url" => "https://api.redoxengine.com/extensions/user-role",
                        // The value below depends on the user specified above in the user id; populate this with a SNOMED CT code.
                        // See here: https://www.hl7.org/fhir/valueset-practitioner-role.html
                        "coding" => [
                            "code" => "112247003",
                            // This is set for the default code (112247003), but change this if you have a different code.
                            "display" => "Medical Doctor"
                        ]
                    ],
                    "purpose-of-use"=> [
                        "url"=> "https://api.redoxengine.com/extensions/purpose-of-use",
                        // The purpose of use is almost always 'treatment', but it depends on your app's purpose.
                        // If you have a different purpose of use, other Carequality participants won't likely respond.
                        // To participate in the Framework, you must also push data.
                        "coding"=> [
                            "code"=> "TREATMENT",
                            "display"=> "Treatment"
                        ]
                    ]
                ],
                "DataModel"=> "PatientSearch",
                "EventType"=> "Query",
                // You should remove the field below for a production environment.
                "Test"=> true,
                "Destinations"=> [
                    [
                        // This value is standard Redox Meta structure and will be different for development, testing, and production environments -- Note that this request is set up for testing.
                        "ID"=> "adf917b5-1496-4241-87e2-ed20434b1fdb"
                    ]
                ]
            ],
            "Patient"=> [
                "Demographics"=> [
                    "FirstName"=> "Gerard",
                    "LastName"=> "Cremin",
                    "DOB"=> "1989-12-25",
                    "Sex"=> "Male",
                    "SSN" => "999-86-7555"
                ]
            ]
            ]
        );
        // $response gives the response but with no information.
        // $response->json() gives the real response with the patient ids
        // dd($response->json());

        $IDType = $response->json()['Patient']['Identifiers'][0]['IDType'];
        $ID = $response->json()['Patient']['Identifiers'][0]['ID'];

        // now we have the patient's ids, so we can search for the organizations. 
        // RLS Patient location search


        $responseOrganizations = Http::acceptJson()->withToken('0b86eddc-a33c-4b88-89d5-6b798c7b485b')->post('https://api.redoxengine.com/endpoint',
        [
            "Meta"=> [
                "Extensions"=>[
                    "sender-organization-id"=>[
                        "url"=>"https://api.redoxengine.com/extensions/sender-organization-id",
                        // The value below should be the OID for your organization. If you have multiple levels, it helps to be specific, but you can also use your top-level OID.
                        "string"=>"2.16.840.1.113883.3.6147.458.11339.2.1.1"
                    ],
                    "user-id"=>[
                        "url"=>"https://api.redoxengine.com/extensions/user-id",
                        // The value below should change per query and should be a human-readable ID for the user (typically this is a name, not an actual ID).
                        "string"=>"pepitoGonzalez"
                    ],
                    "user-role"=>[
                        "url"=>"https://api.redoxengine.com/extensions/user-role",
                        // The value below depends on the user specified above in the user id; populate this with a SNOMED CT code.
                        // See here=>https://www.hl7.org/fhir/valueset-practitioner-role.html
                        "coding"=>[
                            "code"=>"112247003",
                            // This is set for the default code (112247003), but change this if you have a different code.
                            "display"=>"Medical Doctor"
                        ]
                    ],
                    "purpose-of-use"=>[
                        "url"=>"https://api.redoxengine.com/extensions/purpose-of-use",
                        // The purpose of use is almost always 'treatment', but it depends on your app's purpose.
                        // If you have a different purpose of use, other Carequality participants won't likely respond.
                        // To participate in the Framework, you must also push data.
                        "coding"=>[
                            "code"=>"TREATMENT",
                            "display"=>"Treatment"
                        ]
                    ]
                ],
                "DataModel"=>"PatientSearch",
                "EventType"=>"LocationQuery",
                // You should remove the field below for a production environment.
                "Test"=>true,
                "Destinations"=>[
                    [
                        // This value is standard Redox Meta structure and will be different for development, testing, and production environments -- Note that this request is set up for testing.
                        "ID"=>"adf917b5-1496-4241-87e2-ed20434b1fdb"
                    ]
                ]
            ],
            "Patient"=>[
                "Identifiers"=>[
                    [
                        // These field values will change based on the previous search response. At this time, only one identifier is expected per request.
                        "IDType"=>$IDType,
                        "ID"=>$ID,
                    ]
                ]
            ]
        ]
        );

        dd($responseOrganizations->json());


        // we already know the organization, so we go directly to that organization.

        return $response->json();
    }
}
