<?php namespace App\API\src\ClashOfClans\Locations\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Location extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'locations';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}