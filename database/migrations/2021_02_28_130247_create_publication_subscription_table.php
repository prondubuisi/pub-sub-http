<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_subscription', function (Blueprint $table) {
            $table->id();
            $table->string('topic');
            $table->unsignedBigInteger('publication_id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('message');
            $table->boolean('message_received')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publication_subscription');
    }
}
