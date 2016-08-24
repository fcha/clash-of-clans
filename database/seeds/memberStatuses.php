<?php

use Illuminate\Database\Seeder;

class memberStatuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `wartactics`.`member_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
			(1, 'active', '2016-08-22 04:28:16', '2016-08-22 04:28:16'),
			(2, 'inactive', '2016-08-22 04:28:16', '2016-08-22 04:28:16');");
    }
}
