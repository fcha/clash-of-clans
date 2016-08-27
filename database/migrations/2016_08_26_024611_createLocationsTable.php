<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("CREATE TABLE `locations` (
              `id` int(11) UNSIGNED NOT NULL,
              `result_id` int(11) UNSIGNED NOT NULL,
              `unique_id` int(11) UNSIGNED NOT NULL,
              `is_country` tinyint(4) NOT NULL,
              `name` varchar(100) NOT NULL,
              `created_at` datetime NOT NULL,
              `udpated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
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
