<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueKeyToMemberDetailsResetDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('mysql')->getPdo()->exec("TRUNCATE TABLE `member_details`;");
        DB::connection('mysql')->getPdo()->exec("UPDATE `results` SET status_id = 1 WHERE type_id = 1 AND status_id = 2 AND result != '';");
        DB::connection('mysql')->getPdo()->exec("ALTER TABLE `member_details` ADD UNIQUE( `result_id`, `member_id`);");
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
