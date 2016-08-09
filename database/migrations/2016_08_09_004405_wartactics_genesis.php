<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WartacticsGenesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `results` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `type_id` int(11) NOT NULL,
              `created_at` datetime NOT NULL,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `result` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `result_types` (
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
