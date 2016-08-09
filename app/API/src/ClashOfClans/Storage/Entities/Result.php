<?php namespace App\API\src\ClashOfClans\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Result extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'results';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function type()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Storage\Entities\Type', 'type_id');
	}

}