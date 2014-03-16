<?php
use Illuminate\Http\Response as IlluminateResponse;
class RobotController extends \BaseController {
	public static $messages = array(
			'required' => 'The :attribute field is required.',
			'numeric' => 'The :attribute field is numeric.',
			'between' => 'The :attribute must be between :min - :max.',
			'unique' => 'The :attribute value must be unique.',
			'in' => 'The :attribute must be one of the following types: :values',
		);
	
	/**
	 * Not implamented functions trap
	 *
	 * @return Response
	 */
	public function __call($name, $params)
	{
		return Response::json(array('status'=>'NOT_IMPLEMENTED'), IlluminateResponse::HTTP_NOT_IMPLEMENTED);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return array('status'=>'OK', 'data'=>Robot::all()->toArray());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::json()->all();
		$validator = Validator::make($input, Robot::getRules(), self::$messages);
		if ($validator->fails()) {
			return Response::json(array('status'=>'ERROR', 'message'=> $validator->messages()->toArray()), IlluminateResponse::HTTP_CONFLICT);
		} else {
			$robot = new Robot;
			$robot->name = $input['name'];
			$robot->type = $input['type'];
			$robot->year = $input['year'];
			$robot->save();
			return array('status'=>'CREATED', 'data'=>$robot->toArray());
		}
		return array('status'=>'ERROR', 'data'=>$robot->toArray());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$robot = Robot::find($id);
		if($robot){
			return array('status'=>'FOUND', 'data'=>$robot->toArray());
		}
		return array('status'=>'NOT_FOUND');
	}

	/**
	 * Update the specified resource in storage.
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$robot = Robot::find($id);
		if(!$robot){
			return Response::json(array('status'=>'ERROR', 'message'=> 'Entry does not exists'), IlluminateResponse::HTTP_CONFLICT);
		};
		$input = Input::json()->all();
		$rules = Robot::getRules($robot->id);
		foreach(array_keys($rules) as $key ){
			if(!isset($input[$key])){
				$input[$key] = $robot->$key;
			}
		}
		$validator = Validator::make($input, $rules, self::$messages);
		if ($validator->fails()) {
			return Response::json(array('status'=>'ERROR', 'message'=> $validator->messages()->toArray()), IlluminateResponse::HTTP_CONFLICT);
		} else {
			$robot->name = isset($input['name'])?$input['name']:$robot->name;
			$robot->type = isset($input['type'])?$input['type']:$robot->type;
			$robot->year = isset($input['year'])?$input['year']:$robot->year;
			$robot->save();
			return array('status'=>'UPDATED', 'data'=>$robot->toArray());
		}
		return array('status'=>'ERROR', 'data'=>$robot->toArray());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$robot = Robot::find($id);
		if(!$robot){
			return Response::json(array('status'=>'ERROR', 'message'=> 'Entry does not exists'), IlluminateResponse::HTTP_CONFLICT);
		};
		$robot->delete();
		return array('status'=>'DELETED');
	}
	
	/**
	 * 
	 * @param type $robots
	 * @return type
	 */
	public function search($robots)
	{
		if(count($robots)){
			return array('status'=>'FOUND', 'data'=>$robots);
		}
		return array('status'=>'NOT_FOUND');
	}
	
	/**
	 * List of robot types
	 * @return array robot types names
	 */
	public function typeList()
	{
		$types = DB::table('robots')->whereNull('deleted_at')->groupBy('type')->get(array('type'));
		if(count($types)){
			return array('status'=>'OK', 'data'=>$types);
		}
		return array('status'=>'NOT_FOUND');
	}
	
	/**
	 * Find robot by name
	 * @param string $value
	 * @return array matched robots
	 */
	public static function robotName($value)
	{
		return Robot::where('name', 'like', $value.'%')->get()->toArray();
	}
	
	/**
	 * Find robot by type
	 * @param string $value robot type
	 * @return array specific type robots
	 */
	public static function robotType($value)
	{
		return Robot::where('type', $value)->get()->toArray();
	}
	
}