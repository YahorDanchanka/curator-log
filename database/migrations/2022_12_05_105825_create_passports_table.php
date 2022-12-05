<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->string('series');
            $table->string('number');
            $table->string('district_department');
            $table->date('issue_date');
            $table->foreignId('student_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('passports');
    }
};
