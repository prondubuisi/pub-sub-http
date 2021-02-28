<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Requests\PublicationRequest;
use App\Models\PublicationSubscription;
use Illuminate\Support\Facades\Log;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created publication in database.
     * Broadcast publication event
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationRequest $request)
    {
        $validatedData = $request->validated();

        try {

            $subscription =  Publication::create($validatedData);
            $responseData = [
                'response' => "Publication to topic added successfully",
                'topic' => $validatedData['topic'],
                'message' =>  $validatedData['message'],
            ];

            //Next step
            //Broadcast event
            //Broadcast should show message to all subscribers

            // //Add subscription to pivot table
            // PublicationSubscription::create(
            //     [
            //         'topic' => $validatedData['topic'],
            //         'subscription_id' => $subscription->id,
            //     ]
            // );

            return response()->json(["data" => $responseData], 201);
        }
        catch(\Exception $exception) {
            dd($exception);
            Log::debug($exception);
            return response()->json(["response" => 'Something went wrong try again later'], 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
