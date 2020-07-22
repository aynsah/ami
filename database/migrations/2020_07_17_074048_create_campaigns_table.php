<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_desc');
            $table->binary('image_cover');
            $table->text('body');
            $table->integer('target');
            $table->datetime('deadline');
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->index('campaign_category_id');
            $table->index('user_id');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('campaign_category_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}