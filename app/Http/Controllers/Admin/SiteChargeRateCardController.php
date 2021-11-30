<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\SiteType;
use App\Models\SiteChargeRateCard;
use Illuminate\Http\Request;

class SiteChargeRateCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Site $site)
    {
        $site = $site->load(['charge_rate_card', 'charge_rate_card.site_type']);
        $charge_rate_cards = $site->charge_rate_card;
        return view('admin.site.charge_rate_card.list', compact('charge_rate_cards', 'site'))->render();
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
            $charge_rate_card = new SiteChargeRateCard();
            $charge_rate_card->site_id = $site->id;
            $charge_rate_card->site_type_id = $request->add_charge_rate_card_site_type_id;
            $charge_rate_card->rate = $request->add_charge_rate_card_rate;
            $charge_rate_card->save();

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
     * @param \App\Models\SiteChargeRateCard $siteChargeRateCard
     * @return \Illuminate\Http\Response
     */
    public function show(SiteChargeRateCard $siteChargeRateCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SiteChargeRateCard $siteChargeRateCard
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteChargeRateCard $siteChargeRateCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SiteChargeRateCard $siteChargeRateCard
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site, SiteChargeRateCard $charge_rate_card)
    {
        try {

            $charge_rate_card->site_type_id = $request->edit_charge_rate_card_site_type_id;
            $charge_rate_card->rate = $request->edit_charge_rate_card_rate;
            $charge_rate_card->save();

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
     * @param \App\Models\SiteChargeRateCard $charge_rate_card
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site, SiteChargeRateCard $charge_rate_card)
    {
        try {

            if ($charge_rate_card->delete()) {
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
