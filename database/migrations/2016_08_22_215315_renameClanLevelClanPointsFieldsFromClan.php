<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameClanLevelClanPointsFieldsFromClan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `clan`
            CHANGE `clan_level` `level` INT(11) UNSIGNED NOT NULL,
            CHANGE `clan_points` `points` INT(11) UNSIGNED NOT NULL;");
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
