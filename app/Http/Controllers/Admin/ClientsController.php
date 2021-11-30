<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Notes;
use App\Models\Site;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Class ClientsController
 * @package App\Http\Controllers\Admin
 */
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clients.index');
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
    public function store(Request $request)
    {
        $data = [
            'name' => $request->add_name,
            'phone_number' => $request->add_phone_number,
            'mobile_number' => $request->add_mobile_number,
            'email' => $request->add_email,
            'registration_number' => $request->add_registration_number,
            'vat_number' => $request->add_vat_number,
            'address' => $request->add_address,
            'postal_code' => $request->add_postal_code,
            'city' => $request->add_city,
            'country' => $request->add_country,
        ];

        if ($request->hasFile('add_profile_path')) {
            $file_name = time() . '-client' . '.' . $request->add_profile_path->extension();
            $filePath = '/profile/clients/';
            $request->add_profile_path->move(public_path($filePath), $file_name);
            $data = array_merge($data, ['profile_path' => $filePath . $file_name]);
        }

        $exists = Clients::where('email', $request->add_email)
            ->orWhere('phone_number', $request->add_phone_number)
            ->orWhere('mobile_number', $request->add_mobile_number)
            ->exists();
        if ($exists) {
            $response = array('status' => 'error', 'message' => 'Client Already existed');
            return response()->json($response, 403);
        }


        $client = Clients::create($data);
        if ($client) {
            $response = array('status' => 'success', 'message' => 'Data Inserted Successful');
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not inserted try again');
        return response()->json($response, 403);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Clients $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Clients $client)
    {
        $sites = Site::where('client_id', $client->id)->get();
        return view('admin.clients.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Clients $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Clients $clients
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Clients $client)
    {
        $client->name = $request->edit_name;
        $client->phone_number = $request->edit_phone_number;
        $client->mobile_number = $request->edit_mobile_number;
        $client->email = $request->edit_email;
        $client->registration_number = $request->edit_registration_number;
        $client->vat_number = $request->edit_vat_number;
        $client->address = $request->edit_address;
        $client->postal_code = $request->edit_postal_code;
        $client->city = $request->edit_city;
        $client->country = $request->edit_country;

        if ($request->hasFile('edit_profile_path')) {

            if (file_exists(public_path($request->old_profile_path))) {
                File::delete(public_path($request->old_profile_path));
            }

            $file_name = time() . '-client' . '.' . $request->edit_profile_path->extension();
            $filePath = '/profile/clients/';
            $request->edit_profile_path->move(public_path($filePath), $file_name);

            $client->profile_path = $filePath . $file_name;
        }

        if ($client->save()) {
            $client->profile_path = URL::to($client->profile_path);
            $response = array('status' => 'success', 'message' => 'Data Updated Successful', "client" => $client);
            return response()->json($response, 200);
        }

        $response = array('status' => 'error', 'message' => 'Data not updated try again');
        return response()->json($response, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Clients $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Clients $client)
    {
        if (file_exists(public_path($client->profile_path))) {
            File::delete(public_path($client->profile_path));
        }
        try {

            if ($client->delete()) {
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

    /**
     * @param Request $request
     */
    public function showData(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'profile_path',
            3 => 'phone_number',
            4 => 'mobile_number',
            5 => 'email',
            6 => 'registration_number',
            7 => 'vat_number',
            8 => 'postal_code',
            9 => 'city',
            10 => 'country',
        );
        $totalData = Clients::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $results = Clients::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $results = Clients::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('registration_number', 'LIKE', "%{$search}%")
                ->orWhere('vat_number', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Clients::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone_number', 'LIKE', "%{$search}%")
                ->orWhere('mobile_number', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('registration_number', 'LIKE', "%{$search}%")
                ->orWhere('vat_number', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = array();
        if (!empty($results)) {
            foreach ($results as $key => $row) {
                $params = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = "<a href='" . route('admin.client.show', ['client' => $row->id]) . "'>" . $row->name . "</a>";
                $path = asset($row->profile_path);
                $nestedData['profile_path'] = "<img class='img-thumbnail' src='$path' alt='' style='width:60px'/>";
                $nestedData['phone_number'] = $row->phone_number;
                $nestedData['mobile_number'] = $row->mobile_number;
                $nestedData['email'] = $row->email;
                $nestedData['registration_number'] = $row->registration_number;
                $nestedData['vat_number'] = $row->vat_number;
                $nestedData['city'] = $row->city;
                $nestedData['country'] = $row->country;
                $nestedData['postal_code'] = $row->postal_code;

                $id = $row->id;
                $del_link = route("admin.client.destroy", ["client" => $id]);
                $show_link = route("admin.client.show", ["client" => $row->id]);
                $csrf = csrf_token();

                $editButton = '';
                if (hasPermission('edit_client')) {
                    $editButton = "<button title='Edit' class='edit_data mr-2 btn btn-primary btn-sm' data-params='$params'><i class='far fa-edit'></i></button>";
                };
                $deleteButton = '';
                if (hasPermission('delete_client')) {
                    $deleteButton = "<button type='submit' title='Delete' class='delete_data btn btn-danger btn-sm' data-id='$row->id'>
                    <i class='fas fa-trash-alt'></i></button>";
                };
                $viewButton = '';
                if (hasPermission('client_list')) {
                    $viewButton = "<a href='$show_link' title='show' class='ml-2 btn btn-secondary btn-sm'><i class='far fa-eye'></i></a>";
                };
                $nestedData['options'] = "
<div class='btn-group' role='group'>
        $editButton
       <form action='$del_link' method='POST' class='delete_form'>
        <input type='hidden' name='_token' value='$csrf'>
        <input type='hidden' name='_method' value='delete' />
        $deleteButton
        </form>
        $viewButton
        </div>
        ";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function notesList(Clients $client)
    {
        $notes = $client->notes()->orderByDesc('id')->get();

        return view('admin.clients.notes.notes_list', compact('notes'))->render();
    }

    public function saveNotes(Request $request, Clients $client)
    {
        $notes = new Notes();
        $notes->description = $request->description;

        if ($client->notes()->save($notes)) {
            $response = array('status' => 'success', 'message' => 'Data Added Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Added Successful');
        return response()->json($response, 403);
    }

    public function deleteNotes(Request $request)
    {
        $note = Notes::find($request->id);
        if ($note->delete()) {
            $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
        return response()->json($response, 403);
    }
}
