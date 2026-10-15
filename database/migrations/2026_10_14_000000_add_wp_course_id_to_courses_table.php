<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // ID del curso de Tutor LMS en gerscol.com. Varios cursos de aquí
            // (variantes de nombre, versión en inglés) pueden apuntar al mismo
            // curso de WordPress; vacío = no existe en WordPress.
            $table->unsignedBigInteger('wp_course_id')->nullable()->index()->after('course_validation');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('wp_course_id');
        });
    }
};
