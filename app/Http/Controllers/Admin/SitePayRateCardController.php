<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Designation;
use App\Models\SitePayRateCard;
use Illuminate\Http\Request;

class SitePayRateCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Site $site)
    {
        $site = $site->load(['pay_rate_card', 'pay_rate_card.designation']);
        $pay_rate_cards = $site->pay_rate_card;
        return view('admin.site.pay_rate_card.list', compact('pay_rate_cards', 'site'))->render();
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
            $pay_rate_card = new SitePayRateCard();
            $pay_rate_card->site_id = $site->id;
            $pay_rate_card->designation_id = $request->add_pay_rate_card_designation_id;
            $pay_rate_card->rate = $request->add_pay_rate_card_rate;
            $pay_rate_card->save();
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
     * @param \App\Models\SitePayRateCard $sitePayRateCard
     * @return \Illuminate\Http\Response
     */
    public function show(SitePayRateCard $sitePayRateCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SitePayRateCard $sitePayRateCard
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site, SitePayRateCard $pay_rate_card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SitePayRateCard $sitePayRateCard
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site, SitePayRateCard $pay_rate_card)
    {
        try {
            $pay_rate_card->designation_id = $request->edit_pay_rate_card_designation_id;
            $pay_rate_card->rate = $request->edit_pay_rate_card_rate;
            $pay_rate_card->save();
            $response = array('status' => 'success', "message" => "Data Updated Successfully");
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = array('status' => 'error', "message" => $e->getMessage());
            return response()->json($response, 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SitePayRateCard $pay_rate_card
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site, SitePayRateCard $pay_rate_card)
    {
        try {

            if ($pay_rate_card->delete()) {
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
