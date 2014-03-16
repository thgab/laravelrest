<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Robot extends Eloquent
{
	protected $softDelete = true;
	protected $hidden = array('deleted_at','updated_at');
	private static $validTypes = array('Android', 'Cyborg', 'Mecha');

	public static function getRules($id=null)
	{
		return array(
			'name'       => 'required|unique:robots,name'.($id?','.$id:''),
			'type'      => 'required|in:'.implode(',',self::$validTypes),
			'year' => 'required|numeric|between:1000,9999'
		);
	}
}
