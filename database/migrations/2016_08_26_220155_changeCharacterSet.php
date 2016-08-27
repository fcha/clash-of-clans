<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCharacterSet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("TRUNCATE TABLE members;");
        DB::connection('mysql')->getPdo()->exec("TRUNCATE TABLE member_details;");
        DB::connection('mysql')->getPdo()->exec("TRUNCATE TABLE clan;");
        DB::connection('mysql')->getPdo()->exec("TRUNCATE TABLE results;");
        DB::connection('mysql')->getPdo()->exec("ALTER DATABASE `wartactics` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `leagues` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `locations` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `members` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_details` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_detail_statuses` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_statuses` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `migrations` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `password_resets` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `results` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `result_statuses` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `result_types` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `roles` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `war_frequency` `war_frequency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `tag` `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `type` `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `badge_small` `badge_small` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `badge_medium` `badge_medium` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `badge_large` `badge_large` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan` CHANGE `description` `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `leagues` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `leagues` CHANGE `small_icon` `small_icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `leagues` CHANGE `tiny_icon` `tiny_icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `locations` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_detail_statuses` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_statuses` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `members` CHANGE `tag` `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `members` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `result_statuses` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `result_types` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `roles` CHANGE `name` `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
