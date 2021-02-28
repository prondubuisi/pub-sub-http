<?php

namespace App\Providers;

use App\Providers\TopicPublished;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\Subscription;

class NotifySubscriber
{
    /**
     * Publication attribute
     */
    protected $publication;
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TopicPublished  $event
     * @return void
     */
    public function handle(TopicPublished $event)
    {
        //find subscriptions to topic
        // attach publication topic, message and messaged_received to subscription in pivot table
        try {
            $this->publication =  $event->publication;
            (new Subscription())->where('topic', $this->publication->topic)->chunk(20, function ($subscriptions) {
                
                foreach ($subscriptions as $subscription){
                    $subscription->publications()->attach($this->publication,
                        [
                            'topic' => $this->publication->topic,
                            'message' => $this->publication->message,
                            'message_received' => true,
                        ]
                    );
                }
            });

            //mark publication as delivered
            $this->publication->message_delivered = true;
            $this->publication->save();
        }
        catch(\Exception $exception){
            Log::debug($exception);
        }
        
    }
}
