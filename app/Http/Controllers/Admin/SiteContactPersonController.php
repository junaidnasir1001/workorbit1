<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPerson;
use App\Models\Site;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SiteContactPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Site $site)
    {
        //$client = Clients::find($request->client_id);
        $contact_persons = $site->contact_person;
        return view('admin.site.contact_person.list', compact('contact_persons', 'site'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Site $site)
    {
        try {
            $contact_person = new ContactPerson();
            $contact_person->title = $request->add_contact_person_title;
            $contact_person->name = $request->add_contact_person_name;
            $contact_person->job_title = $request->add_contact_person_job_title;
            $contact_person->phone_number = $request->add_contact_person_phone_number;
            $contact_person->email = $request->add_contact_person_email;
            $contact_person->address = $request->add_contact_person_address;
            $contact_person->postal_code = $request->add_contact_person_postal_code;
            $site->contact_person()->save($contact_person);
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Staff $staff, ContactPerson $contact_person)
    {
        try {
            $contact_person->title = $request->edit_contact_person_title;
            $contact_person->name = $request->edit_contact_person_name;
            $contact_person->job_title = $request->edit_contact_person_job_title;
            $contact_person->phone_number = $request->edit_contact_person_phone_number;
            $contact_person->email = $request->edit_contact_person_email;
            $contact_person->address = $request->edit_contact_person_address;
            $contact_person->postal_code = $request->edit_contact_person_postal_code;

            $contact_person->save();
            $response = array('status' => 'success', "message" => "Data Updated Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 402);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site, ContactPerson $contact_person)
    {
        try {
            if ($contact_person->delete()) {
                $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
                return response()->json($response, 200);
            }
            $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
            return response()->json($response, 403);

        } catch (\Exception  $th) {
            $response = array('status' => 'error', 'message' => $th->getMessage());
            return response()->json($response, 403);
        }
    }
}
