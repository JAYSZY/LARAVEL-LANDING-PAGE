<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
            CREATE TABLE facility_requests_new (
                id integer primary key autoincrement not null,
                facility_name varchar not null,
                region varchar not null,
                contact_name varchar not null,
                position varchar not null,
                contact_number varchar not null,
                email varchar not null,
                message text,
                status varchar check ("status" in (\'pending\', \'reviewing\', \'approved\', \'denied\')) not null default \'pending\',
                admin_notes text,
                created_at datetime,
                updated_at datetime
            )
        ');

        DB::statement("
            INSERT INTO facility_requests_new
            SELECT id, facility_name, region, contact_name, position, contact_number, email, message,
                CASE status
                    WHEN 'contacted' THEN 'reviewing'
                    WHEN 'declined' THEN 'denied'
                    ELSE status
                END,
                admin_notes, created_at, updated_at
            FROM facility_requests
        ");

        DB::statement('DROP TABLE facility_requests');
        DB::statement('ALTER TABLE facility_requests_new RENAME TO facility_requests');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('
            CREATE TABLE facility_requests_old (
                id integer primary key autoincrement not null,
                facility_name varchar not null,
                region varchar not null,
                contact_name varchar not null,
                position varchar not null,
                contact_number varchar not null,
                email varchar not null,
                message text,
                status varchar check ("status" in (\'pending\', \'contacted\', \'approved\', \'declined\')) not null default \'pending\',
                admin_notes text,
                created_at datetime,
                updated_at datetime
            )
        ');

        DB::statement("
            INSERT INTO facility_requests_old
            SELECT id, facility_name, region, contact_name, position, contact_number, email, message,
                CASE status
                    WHEN 'reviewing' THEN 'contacted'
                    WHEN 'denied' THEN 'declined'
                    ELSE status
                END,
                admin_notes, created_at, updated_at
            FROM facility_requests
        ");

        DB::statement('DROP TABLE facility_requests');
        DB::statement('ALTER TABLE facility_requests_old RENAME TO facility_requests');
    }
};
