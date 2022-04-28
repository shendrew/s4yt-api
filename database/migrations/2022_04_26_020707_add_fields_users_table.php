<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->string('school')->nullable();
            $table->foreignId('education_id')->constrained('educations');
            $table->foreignId('grade_id')->nullable()->constrained('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'school'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('school');
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_education_id_foreign');
            $table->dropColumn('education_id');
            $table->dropForeign('users_grade_id_foreign');
            $table->dropColumn('grade_id');
        });
    }
}
