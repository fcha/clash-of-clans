<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(memberDetailStatuses::class);
        $this->call(resultTypes::class);
        $this->call(resultStatuses::class);
        $this->call(roles::class);

        Model::reguard();
    }
}
