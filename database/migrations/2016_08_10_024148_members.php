<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Members extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `members` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `result_id` int(11) unsigned NOT NULL,
              `role_id` int(11) unsigned NOT NULL,
              `league_id` int(11) unsigned NOT NULL,
              `experience` int(11) unsigned NOT NULL,
              `trohpies` int(11) NOT NULL,
              `current_rank` int(11) NOT NULL,
              `previous_rank` int(11) NOT NULL,
              `troops_donated` int(11) NOT NULL,
              `troops_received` int(11) NOT NULL,
              `tag` varchar(100) NOT NULL,
              `name` varchar(100) NOT NULL,
              `created_at` datetime NOT NULL,
              `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `roles` (
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
