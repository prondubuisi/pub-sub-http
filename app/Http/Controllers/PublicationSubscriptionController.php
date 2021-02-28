<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class PublicationSubscriptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $endpoint)
    {
        try{
            //get Subscription where url like
            $subscription =  Subscription::where('callback_url','LIKE','%'. $endpoint .'%')->first();
            
            //if subscription does not exist with specified endpoint
            if(!$subscription)
            {
                return response()->json(['essage' => 'No known subscriptions for this endpoint'], 404);
            }
            $endpointMessages = [];
            foreach ($subscription->publications as $publication) {
                //add every publication message to suscriber
                $endpointMessages [] = $publication->message;
            }

            return response()->json(['message(s)' => $endpointMessages], 200);
        }
        catch(\Exception $exception){
            Log::debug($exception);
            return response()->json(['response' => 'Something went wrong try again later'], 500);
        }
        
    }
}
