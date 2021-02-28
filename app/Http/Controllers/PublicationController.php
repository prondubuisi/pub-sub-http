<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Requests\PublicationRequest;
use App\Models\PublicationSubscription;
use Illuminate\Support\Facades\Log;
use App\Providers\TopicPublished;

class PublicationController extends Controller
{
    
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

            $publication =  Publication::create($validatedData);
            $responseData = [
                'response' => 'Publication to topic added successfully',
                'topic' => $validatedData['topic'],
                'message' =>  $validatedData['message'],
            ];

            // Broadcast publication event to suscribers
            TopicPublished::dispatch($publication);

            return response()->json(['data' => $responseData], 201);
        }
        catch(\Exception $exception) {
            Log::debug($exception);
            return response()->json(['response' => 'Something went wrong try again later'], 500);
        }
        
    }
    
}
