<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusFieldTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE IF NOT EXISTS `result_statuses` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(100) NOT NULL,
              `created_at` datetime NOT NULL,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");

        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `results` ADD `status_id` INT(11) UNSIGNED NOT NULL DEFAULT '1' AFTER `type_id`;");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `results` CHANGE `type_id` `type_id` INT(11) UNSIGNED NOT NULL;");
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
