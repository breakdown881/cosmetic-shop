<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('created_by')->index('CREATED_BY')->after('featured');
            $table->smallInteger('status')->default(0)->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('CREATED_BY');
            $table->dropColumn(['created_by', 'status']);
        });
    }
};
