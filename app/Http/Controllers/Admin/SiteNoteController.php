<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notes;
use App\Models\Site;
use Illuminate\Http\Request;

/**
 * Class SiteNoteController
 * @package App\Http\Controllers\Admin
 */
class SiteNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Site $site)
    {
        $notes = $site->notes()->orderByDesc('id')->get();

        return view('admin.site.notes.notes_list', compact('notes'))->render();
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
        $notes = new Notes();
        $notes->description = $request->description;

        if ($site->notes()->save($notes)) {
            $response = array('status' => 'success', 'message' => 'Data Added Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Added Successful');
        return response()->json($response, 403);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site, Notes $note)
    {
        //$note = Notes::find($request->id);
        if ($note->delete()) {
            $response = array('status' => 'success', 'message' => 'Data Deleted Successful');
            return response()->json($response, 200);
        }
        $response = array('status' => 'error', 'message' => 'Data Not Deleted Successful');
        return response()->json($response, 403);
    }
}
