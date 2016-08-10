<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `leagues` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `result_id` int(11) unsigned NOT NULL,
              `unique_id` int(11) unsigned NOT NULL,
              `name` varchar(100) NOT NULL,
              `small_icon` text NOT NULL,
              `tiny_icon` text NOT NULL,
              `created_at` datetime NOT NULL,
              `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
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
