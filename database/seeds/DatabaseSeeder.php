<?php

use database\resultTypes;
use database\resultStatuses;
use database\roles;
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

        $this->call(resultTypes::class);
        $this->call(resultStatuses::class);
        $this->call(roles::class);

        Model::reguard();
    }
}
