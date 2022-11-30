<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('individual_works', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['parents', 'students']);
            $table->date('date');
            $table->string('content');
            $table->string('result');
            $table->foreignId('student_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('individual_works');
    }
};
