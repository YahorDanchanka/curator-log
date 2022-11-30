<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('graduated');
            $table->string('passport_data');
            $table->string('relationship');
            $table->string('hobbies');
            $table->string('address');
            $table->string('health');
            $table->string('other_details')->nullable();
            $table->foreignId('mother_id')->nullable()->constrained('users');
            $table->foreignId('father_id')->nullable()->constrained('users');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
