<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `members`
            ADD `status_id` INT(11) UNSIGNED NOT NULL DEFAULT 1 AFTER `id`;");

        DB::connection('mysql')->getPdo()->exec("CREATE TABLE `member_statuses` (
              `id` int(11) UNSIGNED NOT NULL,
              `name` varchar(100) NOT NULL,
              `created_at` datetime NOT NULL,
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
