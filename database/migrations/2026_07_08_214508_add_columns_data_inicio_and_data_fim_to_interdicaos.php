<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('interdicaos', function (Blueprint $table) {
            $table->dateTime('data_inicio')->nullable()->after('id');
            $table->dateTime('data_fim')->nullable()->after('data_inicio');
        });

        DB::table('interdicaos')->update([
            'data_inicio' => DB::raw('created_at')
        ]);

        Schema::table('interdicaos', function (Blueprint $table) {
            $table->dateTime('data_inicio')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interdicaos', function (Blueprint $table) {
            $table->dropColumn(['data_inicio', 'data_fim']);
        });
    }
};
