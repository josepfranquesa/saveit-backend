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
        Schema::table('registers', function (Blueprint $table) {
            $table->foreignId('periodic_id')->nullable()->constrained('periodics')->onDelete('set null');
        });

        Schema::table('periodics', function (Blueprint $table) {
            $table->foreignId('register_id')->unique()->constrained('registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registers', function (Blueprint $table) {
            $table->dropForeign(['periodic_id']);
            $table->dropColumn('periodic_id');
        });

        Schema::table('periodics', function (Blueprint $table) {
            $table->dropForeign(['register_id']);
            $table->dropColumn('register_id');
        });
    }
};
