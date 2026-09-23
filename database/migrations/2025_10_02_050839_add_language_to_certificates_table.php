<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Guarded: on at least one environment this column was already added
        // by hand (outside migrations) before this file ever ran, which made
        // a plain migrate() fail with "Duplicate column name".
        if (Schema::hasColumn('certificates', 'language')) {
            return;
        }

        Schema::table('certificates', function (Blueprint $table) {
            $table->string('language', 2)->default('es')->after('certificate_expedition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('certificates', 'language')) {
            return;
        }

        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('language');
        });
    }
};
