<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpressions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('impressions'))
        {
            Schema::create('impressions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('event_name');
                $table->unsignedInteger('user_id');
                $table->text('data'); //Text is used here because encrypted text strings are very long.
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('impressions');
    }
}
