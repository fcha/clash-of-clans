<?php namespace App\API\src\ClashOfClans\Members\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class League extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'leagues';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}