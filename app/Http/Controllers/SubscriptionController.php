<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PublicationSubscription;

class SubscriptionController extends Controller
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
     * Stores a newly created subscribtion in database.
     * Adds subscription to publication/subscription link table
     * 
     * @param  App\Http\Requests\SubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {
        $validatedData = $request->validated();

        try {

            //map post data to table field for mass asignment
            $validatedData['callback_url'] =   $validatedData['url'];

            $subscription =  Subscription::create($validatedData);
            $responseData = [
                'response' => "Subcription to topic added successfully",
                'topic' => $validatedData['topic'],
                'url' =>  $validatedData['url'],
            ];

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
            Log::debug($exception);
            return response()->json(["response" => 'Something went wrong try again later'], 500);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
