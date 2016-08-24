<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMemberCreateMemberDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `members`
            DROP `result_id`,
            DROP `role_id`,
            DROP `league_id`,
            DROP `experience`,
            DROP `trophies`,
            DROP `current_rank`,
            DROP `previous_rank`,
            DROP `troops_donated`,
            DROP `troops_received`;");

        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `member_details` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `result_id` int(11) unsigned NOT NULL,
              `member_id` int(11) unsigned NOT NULL,
              `league_id` int(11) unsigned NOT NULL,
              `status_id` int(11) unsigned NOT NULL,
              `experience` int(11) unsigned NOT NULL,
              `trohpies` int(11) NOT NULL,
              `current_rank` int(11) NOT NULL,
              `previous_rank` int(11) NOT NULL,
              `troops_donated` int(11) NOT NULL,
              `troops_received` int(11) NOT NULL,
              `created_at` datetime NOT NULL,
              `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `member_detail_statuses` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(100) NOT NULL,
              `created_at` datetime NOT NULL,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
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
