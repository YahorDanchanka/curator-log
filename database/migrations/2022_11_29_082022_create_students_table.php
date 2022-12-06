<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('home_phone_number')->nullable();
            $table->string('graduated');
            $table->string('relationship')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('address')->nullable();
            $table->string('health');
            $table->string('social_conditions')->nullable();
            $table->string('apprenticeship');
            $table->date('certificate_date');
            $table->string('other_details')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
