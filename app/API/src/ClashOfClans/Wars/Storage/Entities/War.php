<?php namespace App\API\src\ClashOfClans\Wars\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class War extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'wars';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}