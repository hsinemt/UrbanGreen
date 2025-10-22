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
        Schema::table('resources', function (Blueprint $table) {
            // Add supplier_id column (references users table)
            $table->foreignId('supplier_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->onDelete('set null')
                ->comment('The supplier (user) who added this resource');

            // Add event_id column (references events table)
            $table->foreignId('event_id')
                ->nullable()
                ->after('supplier_id')
                ->constrained('events')
                ->onDelete('cascade')
                ->comment('The event this resource belongs to');

            // Add description column if it doesn't exist
            if (!Schema::hasColumn('resources', 'description')) {
                $table->text('description')
                    ->nullable()
                    ->after('quantity')
                    ->comment('Additional details about the resource');
            }

            // Add indexes for better query performance
            $table->index('supplier_id', 'idx_resources_supplier');
            $table->index('event_id', 'idx_resources_event');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['event_id']);

            // Drop indexes
            $table->dropIndex('idx_resources_supplier');
            $table->dropIndex('idx_resources_event');

            // Drop columns
            $table->dropColumn(['supplier_id', 'event_id']);

            // Optionally drop description if you added it
            // $table->dropColumn('description');
        });
    }
};
