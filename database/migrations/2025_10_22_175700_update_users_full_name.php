<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->after('id');
        });

        // Backfill full_name from first_name and last_name if they exist
        try {
            DB::statement("UPDATE users SET full_name = TRIM(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))) ");
        } catch (\Throwable $e) {
            // If the statement fails for any reason, ignore; new rows will populate full_name anyway
        }

        // Drop old columns if they exist
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn('first_name');
            }
            if (Schema::hasColumn('users', 'last_name')) {
                $table->dropColumn('last_name');
            }
        });
    }

    public function down(): void
    {
        // Recreate first_name and last_name
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->after('id');
            }
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->after('first_name');
            }
        });

        // Attempt to split full_name back (best-effort)
        try {
            DB::statement("UPDATE users SET first_name = TRIM(SUBSTRING_INDEX(full_name, ' ', 1)), last_name = TRIM(SUBSTRING(full_name, LENGTH(SUBSTRING_INDEX(full_name, ' ', 1)) + 2))");
        } catch (\Throwable $e) {
            // If splitting fails, just copy full_name to first_name
            try {
                DB::statement("UPDATE users SET first_name = full_name, last_name = ''");
            } catch (\Throwable $e2) {
                // ignore
            }
        }

        // Drop full_name
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'full_name')) {
                $table->dropColumn('full_name');
            }
        });
    }
};
