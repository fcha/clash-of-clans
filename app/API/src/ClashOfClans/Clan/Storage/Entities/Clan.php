<?php namespace App\API\src\ClashOfClans\Clan\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Clan extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'clan';
	protected $primaryKey = 'tag';

	public function location()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Locations\Storage\Entities\Location', 'location_id', 'unique_id');
	}

}