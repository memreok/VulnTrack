<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vulnerabilities', function (Blueprint $table) {

            $table->integer('days_open')->nullable()->after('comment_count');
        });
    }

    public function down(): void
    {
        Schema::table('vulnerabilities', function (Blueprint $table) {
            $table->dropColumn('days_open');
        });
    }
};
