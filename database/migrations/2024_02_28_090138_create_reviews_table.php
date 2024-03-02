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
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('week_id')->unsigned();
            $table->foreign('week_id')
                ->references('id')->on('weeks')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->integer('classroom_id')->unsigned();
            $table->foreign('classroom_id')
            ->references('id')->on('classrooms')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->string('result');
            $table->text('notes');
            $table->date('date');
            $table->string('tasks');
            $table->string('lessons');
            $table->string('weekly_plan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
