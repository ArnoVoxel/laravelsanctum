<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Party;
use App\Models\PartyUser;
use Illuminate\Http\Request;
use App\Http\Requests\API\PartyRequest;
use App\Http\Resources\PartyResource;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::where('user_id', auth()->user()->id)->get();
        return $parties;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartyRequest $request)
    {
        // \log::info(__LINE__);
        \Log::info($request->all());
        $current_user = auth()->user();

        $party = new Party();
        $party->label = $request->label;
        $party->description = $request->description;
        $party->date = $request->date;
        $party->user_id = $current_user->id;
        $party->save();

        //foreach member in table_members save a new PartyUser
        foreach($request->table_members as $member) {
            $partyUser = new PartyUser();
            $partyUser->party_id = $party->id;
            $partyUser->email = $member['email'];
            $partyUser->save();
        }

        return $party;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        $data = PartyResource::make($party);
        return ['data' => $data];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(PartyRequest $request, Party $party)
    {
        $data = $request->all();
        $party->update($data);
        return $party;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        //
    }
}
