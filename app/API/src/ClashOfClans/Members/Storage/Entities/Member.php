<?php namespace App\API\src\ClashOfClans\Members\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Member extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'members';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

	public function details()
	{
		return $this->hasMany('App\API\src\ClashOfClans\Members\Details\Storage\Entities\MemberDetail', 'member_id');
	}

}