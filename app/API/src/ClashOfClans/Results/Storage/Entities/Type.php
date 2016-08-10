<?php namespace App\API\src\ClashOfClans\Results\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Type extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'result_types';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}