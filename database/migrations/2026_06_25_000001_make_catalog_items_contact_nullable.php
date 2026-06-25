<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=off');
            DB::statement('BEGIN TRANSACTION');

            DB::statement('CREATE TABLE catalog_items_tmp AS SELECT * FROM catalog_items');
            DB::statement('DROP TABLE catalog_items');
            DB::statement(<<<'SQL'
CREATE TABLE catalog_items (
    id integer primary key autoincrement,
    name varchar(255) not null,
    category varchar(255) not null,
    price integer not null,
    price_label varchar(255) null,
    image varchar(255) null,
    short_desc varchar(255) not null,
    description text not null,
    facilities text not null,
    hours varchar(255) not null,
    contact varchar(255) null,
    address varchar(255) not null,
    lat decimal(10,7) not null default 0,
    lng decimal(10,7) not null default 0,
    instagram varchar(255) null,
    tiktok varchar(255) null,
    route_code varchar(255) null,
    stops text null,
    created_at datetime null,
    updated_at datetime null
);
SQL
            );
            DB::statement('INSERT INTO catalog_items SELECT id,name,category,price,price_label,image,short_desc,description,facilities,hours,contact,address,lat,lng,instagram,tiktok,route_code,stops,created_at,updated_at FROM catalog_items_tmp');
            DB::statement('DROP TABLE catalog_items_tmp');

            DB::statement('COMMIT');
            DB::statement('PRAGMA foreign_keys=on');
        } else {
            Schema::table('catalog_items', function (Blueprint $table) {
                $table->string('contact')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=off');
            DB::statement('BEGIN TRANSACTION');

            DB::statement('CREATE TABLE catalog_items_tmp AS SELECT * FROM catalog_items');
            DB::statement('DROP TABLE catalog_items');
            DB::statement(<<<'SQL'
CREATE TABLE catalog_items (
    id integer primary key autoincrement,
    name varchar(255) not null,
    category varchar(255) not null,
    price integer not null,
    price_label varchar(255) null,
    image varchar(255) null,
    short_desc varchar(255) not null,
    description text not null,
    facilities text not null,
    hours varchar(255) not null,
    contact varchar(255) not null,
    address varchar(255) not null,
    lat decimal(10,7) not null default 0,
    lng decimal(10,7) not null default 0,
    instagram varchar(255) null,
    tiktok varchar(255) null,
    route_code varchar(255) null,
    stops text null,
    created_at datetime null,
    updated_at datetime null
);
SQL
            );
            DB::statement('INSERT INTO catalog_items SELECT id,name,category,price,price_label,image,short_desc,description,facilities,hours,contact,address,lat,lng,instagram,tiktok,route_code,stops,created_at,updated_at FROM catalog_items_tmp');
            DB::statement('DROP TABLE catalog_items_tmp');

            DB::statement('COMMIT');
            DB::statement('PRAGMA foreign_keys=on');
        } else {
            Schema::table('catalog_items', function (Blueprint $table) {
                $table->string('contact')->nullable(false)->change();
            });
        }
    }
};
