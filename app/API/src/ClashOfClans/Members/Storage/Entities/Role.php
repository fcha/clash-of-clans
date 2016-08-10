<?php namespace App\API\src\ClashOfClans\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'roles';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}