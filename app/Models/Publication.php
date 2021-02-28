<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use App\Models\PublicationSubscription;

class Publication extends Model
{
    use HasFactory;
    /**
     * The subscriptions that belong to a publication
     */
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class)->using(PublicationSubscription::class);
    }

}
