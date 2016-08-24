<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixMemberDetails20160820 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_details`
            CHANGE `trohpies` `trophies` INT(11) UNSIGNED NOT NULL;");

        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_details`
            CHANGE `current_rank` `current_rank` INT(11) UNSIGNED NOT NULL,
            CHANGE `previous_rank` `previous_rank` INT(11) UNSIGNED NOT NULL,
            CHANGE `troops_donated` `troops_donated` INT(11) UNSIGNED NOT NULL,
            CHANGE `troops_received` `troops_received` INT(11) UNSIGNED NOT NULL;");

        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_details`
            ADD `role_id` INT(11) UNSIGNED NOT NULL AFTER `result_id`;");
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
