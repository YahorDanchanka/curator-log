<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('student_user', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['mother', 'father', 'brother', 'sister']);
            $table
                ->foreignId('student_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_user');
    }
};
