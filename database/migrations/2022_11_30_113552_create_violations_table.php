<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('actions');
            $table->string('measures');
            $table->string('result');
            $table
                ->foreignId('student_id')
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('violations');
    }
};
