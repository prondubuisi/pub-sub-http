<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publication;
use App\Models\PublicationSubscription;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['topic', 'callback_url'];
    /**
     * The subscriptions that belong to a publication
     */
    public function publications()
    {
        return $this->belongsToMany(Publication::class)
            ->withTimestamps()
            ->using(PublicationSubscription::class);
    }
}
