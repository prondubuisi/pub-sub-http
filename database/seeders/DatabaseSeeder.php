<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use App\Models\Publication;
use App\Models\PublicationSubscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $subscription = Subscription::find(1);
        //seed if table is empty
        if(!$subscription)
        {
            $firstSubscription = Subscription::create(
                [
                    'topic' => 'ordershipped', 
                    'callback_url' => 'http://localhost:8000/order1',
                ]);
            $secondSubscription = Subscription::create(
                [
                    'topic' => 'ordershipped',
                    'callback_url' => 'http://localhost:8000/order2',
                ]
            );
            $thirdSubscription = Subscription::create(
                [
                    'topic' => 'orderdelivered',
                    'callback_url' => 'http://localhost:8000/order3',
                ]
            );
    
            $firstPublication = Publication::create(
                [
                    'topic' => 'ordershipped', 
                    'message' => 'First order shipped',
                ]);
            $secondPublication = Publication::create(
                [
                    'topic' => 'ordershipped',
                    'message' => 'second order shipped',
                ]
            );
            $thirdPublication = Publication::create(
                [
                    'topic' => 'orderdelivered',
                    'message' => 'first order delivered',
                ]
            );
    
            $firstSubscription->publications()->attach($firstPublication,
                [
                    'topic' => $firstPublication->topic,
                    'message' => $firstPublication->message,
                    'message_received' => true,
                ]
            );
    
            $secondSubscription->publications()->attach($firstPublication,
                [
                    'topic' => $firstPublication->topic,
                    'message' => $firstPublication->message,
                    'message_received' => true,
                ]
            );
    
            $secondSubscription->publications()->attach($secondPublication,
                [
                    'topic' => $secondPublication->topic,
                    'message' => $secondPublication->message,
                    'message_received' => true,
                ]
            );
    
            $thirdSubscription->publications()->attach($thirdPublication,
                [
                    'topic' => $thirdPublication->topic,
                    'message' => $thirdPublication->message,
                    'message_received' => true,
                ]
            );
        }
         
    }
}
