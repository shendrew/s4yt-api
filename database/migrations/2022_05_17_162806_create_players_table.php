<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('school')->nullable();
            $table->foreignId('education_id')->nullable()->constrained('educations');
            $table->foreignId('grade_id')->nullable()->constrained('grades');

            $table->string("country",50)->nullable();
            $table->string("state", 3)->nullable();
            $table->string("city_id")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
