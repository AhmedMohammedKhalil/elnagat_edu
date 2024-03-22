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
        Schema::table('reviews', function(Blueprint $table)
        {
            $table->softDeletes();
        });
        Schema::table('classrooms', function(Blueprint $table)
        {
            $table->softDeletes();
        });
        Schema::table('levels', function(Blueprint $table)
        {
            $table->softDeletes();
        });
        Schema::table('teachers', function(Blueprint $table)
        {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function(Blueprint $table)
        {
            $table->dropSoftDeletes();
        });
        Schema::table('classrooms', function(Blueprint $table)
        {
            $table->dropSoftDeletes();
        });
        Schema::table('levels', function(Blueprint $table)
        {
            $table->dropSoftDeletes();
        });
        Schema::table('teachers', function(Blueprint $table)
        {
            $table->dropSoftDeletes();
        });
    }
};
