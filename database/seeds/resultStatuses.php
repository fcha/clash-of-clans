<?php

use Illuminate\Database\Seeder;

class resultStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `wartactics`.`result_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
			(1, 'active', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
			(2, 'completed', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
			(3, 'failed', '2016-08-09 15:44:16', '2016-08-09 15:44:16');");
    }
}
