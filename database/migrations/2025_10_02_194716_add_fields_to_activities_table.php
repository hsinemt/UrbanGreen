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
        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('activities', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('activities', 'status')) {
                $table->string('status')->default('pending')->after('description');
            }
            if (!Schema::hasColumn('activities', 'time_to_finish')) {
                $table->unsignedInteger('time_to_finish')->nullable()->after('status');
            }
            if (!Schema::hasColumn('activities', 'num_persons')) {
                $table->unsignedInteger('num_persons')->default(1)->after('time_to_finish');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            if (Schema::hasColumn('activities', 'num_persons')) {
                $table->dropColumn('num_persons');
            }
            if (Schema::hasColumn('activities', 'time_to_finish')) {
                $table->dropColumn('time_to_finish');
            }
            if (Schema::hasColumn('activities', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('activities', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('activities', 'title')) {
                $table->dropColumn('title');
            }
        });
    }
};
