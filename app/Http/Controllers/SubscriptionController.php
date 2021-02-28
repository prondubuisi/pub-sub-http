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
                'response' => 'Subcription to topic added successfully',
                'topic' => $validatedData['topic'],
                'url' =>  $validatedData['url'],
            ];

            return response()->json(['data' => $responseData], 201);
        }
        catch(\Exception $exception) {
            Log::debug($exception);
            return response()->json(['response' => 'Something went wrong try again later'], 500);
        }
        
    }

}
