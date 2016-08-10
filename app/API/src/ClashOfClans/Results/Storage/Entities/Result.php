<?php namespace App\API\src\ClashOfClans\Results\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Result extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'results';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function type()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Results\Storage\Entities\Type', 'type_id');
	}

	public function members()
	{
		return $this->hasMany('App\API\src\ClashOfClans\Results\Members\Storage\Entities\Member', 'result_id');
	}

}