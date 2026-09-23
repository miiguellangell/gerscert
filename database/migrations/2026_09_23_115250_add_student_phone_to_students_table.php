<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Nullable at the DB level so this migration doesn't break on
            // existing rows — "required" is enforced by form validation for
            // every create/edit going forward instead.
            $table->string('student_phone')->nullable()->after('student_mail');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('student_phone');
        });
    }
};
