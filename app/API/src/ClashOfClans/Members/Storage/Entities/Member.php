<?php namespace App\API\src\ClashOfClans\Members\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Member extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'members';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function role()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Members\Storage\Entities\Role', 'role_id');
	}

	public function result()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Storage\Entities\Result', 'result_id');
	}

	public function league()
	{
		return $this->belongsTo('App\API\src\ClashOfClans\Leagues\Storage\Entities\League', 'league_id', 'unique_id');
	}

}