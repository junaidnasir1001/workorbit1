<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Site;
use App\Models\SubContractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class SubContractorDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(SubContractor $sub_contractor)
    {
        $documents = $sub_contractor->document;
        return view('admin.sub_contractor.document.list', compact('documents', 'sub_contractor'))->render();
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
    public function store(Request $request, SubContractor $sub_contractor)
    {
        try {
            $document = new Document();
            $document->file_name = $request->add_document_file_name;

            if ($request->hasFile('add_document_file_path')) {

                $file_name = time() . '-document' . '.' . $request->add_document_file_path->extension();
                $filePath = '/documents/sub_contractor/';
                $request->add_document_file_path->move(public_path($filePath), $file_name);
                $document->file_path = $filePath . $file_name;

            }

            $sub_contractor->document()->save($document);
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
    public function update(Request $request, SubContractor $sub_contractor, Document $document)
    {
        try {
            $document->file_name = $request->edit_document_file_name;
            if ($request->hasFile('edit_document_file_path')) {

                if (file_exists(public_path($request->hidden_document_old_file_path))) {
                    File::delete(public_path($request->hidden_document_old_file_path));
                }

                $file_name = time() . '-document' . '.' . $request->edit_document_file_path->extension();
                $filePath = '/documents/site/';
                $request->edit_document_file_path->move(public_path($filePath), $file_name);
                $document->file_path = $filePath . $file_name;
            }

            $document->save();
            $response = array('status' => 'success', "message" => "Data Added Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SubContractor $sub_contractor, Document $document)
    {
        try {
            if (file_exists(public_path($document->file_path))) {
                File::delete(public_path($document->file_path));
            }

            if ($document->delete()) {
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

    public function download(SubContractor $sub_contractor, Document $document)
    {
        try {
            $file = public_path($document->file_path);
            return Response::download($file);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
