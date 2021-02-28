<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePubSubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pub_sub', function (Blueprint $table) {
                $table->id();
                $table->string('topic');
                $table->unsignedBigInteger('subscription_id');
                $table->json('message');
                $table->boolean('message_received');
                $table->foreign('subscription_id')->references('id')->on('subscriptions');
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
        Schema::dropIfExists('pub_sub');
    }
}
