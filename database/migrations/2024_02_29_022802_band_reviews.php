<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('band_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('band_id')->unsigned();
            $table->foreign('band_id')
                ->references('id')->on('bands')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('review_id')->unsigned();
            $table->foreign('review_id')
                ->references('id')->on('reviews')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
