<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `clan` (
              `location_id` int(11) unsigned NOT NULL,
              `members` int(11) NOT NULL,
              `clan_level` int(11) unsigned NOT NULL,
              `clan_points` int(11) unsigned NOT NULL,
              `required_trophies` int(11) unsigned NOT NULL,
              `war_win_streak` int(11) NOT NULL,
              `war_wins` int(11) NOT NULL,
              `war_ties` int(11) NOT NULL,
              `war_losses` int(11) NOT NULL,
              `war_frequency` varchar(100) NOT NULL,
              `tag` varchar(100) NOT NULL,
              `name` varchar(100) NOT NULL,
              `type` varchar(100) NOT NULL,
              `badge_small` varchar(255) NOT NULL,
              `badge_medium` varchar(255) NOT NULL,
              `badge_large` varchar(255) NOT NULL,
              `description` text NOT NULL,
              `created_at` datetime NOT NULL,
              `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              KEY (`location_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
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
