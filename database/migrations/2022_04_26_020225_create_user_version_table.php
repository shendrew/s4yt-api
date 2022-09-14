<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_version', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignId('version_id')->constrained('versions');
            $table->boolean('active')->default(1);
            $table->foreignUuid('created_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('version_users');
    }
}
