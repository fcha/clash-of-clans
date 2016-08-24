<?php

use Illuminate\Database\Seeder;

class memberDetailStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `wartactics`.`member_detail_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
			(1, 'current', '2016-08-17 04:28:16', '2016-08-17 04:28:16'),
			(2, 'active', '2016-08-17 04:28:16', '2016-08-17 04:28:16'),
			(3, 'replaced', '2016-08-17 04:28:16', '2016-08-17 04:28:16');");
    }
}
