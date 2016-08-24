<?php namespace App\API\src\ClashOfClans\Clan\Storage\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Clan extends Eloquent {

	protected $connection = 'mysql';
	protected $table = 'clan';
	protected $primaryKey = 'tag';

}