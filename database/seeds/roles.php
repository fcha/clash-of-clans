<?php

use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `wartactics`.`roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
			(1, 'Leader', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
			(2, 'Co-Leader', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
			(3, 'Elder', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
            (4, 'Member', '2016-08-09 15:44:16', '2016-08-09 15:44:16'),
			(5, 'Admin', '2016-08-09 15:44:16', '2016-08-09 15:44:16');");
    }
}
