<?php

use Illuminate\Database\Seeder;

class wartactics extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `wartactics`.`result_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
			(1, 'clans', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(2, 'clan members', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(3, 'clan warlog', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(4, 'locations', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(5, 'location clan rankings', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(6, 'location player rankings', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(7, 'leagues', '2016-08-08 17:20:16', '2016-08-09 00:20:16'),
			(8, 'league seasons', '2016-08-08 17:20:16', '2016-08-09 00:20:16');");
    }

}