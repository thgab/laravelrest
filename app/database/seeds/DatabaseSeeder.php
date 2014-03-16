<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RobotTableSeeder');
	}

}


class RobotTableSeeder extends Seeder {

    public function run()
    {
        DB::table('robots')->truncate();
        Robot::create(array("name" => "Hector", "type" => "Mecha", "year" => "1980"));
		Robot::create(array("name" => "David 8", "type" => "Android", "year" => "2012"));
		Robot::create(array("name" => "Bishop", "type" => "Android", "year" => "1986"));
    }

}