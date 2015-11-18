<?php
use Faker\Generator;
use TeachMe\Entities\User;
use Faker\Factory as Faker;


class UsersTableSeeder extends BaseSeeder
{
	public function getModel()
	{
		return new User();
	}

	public function getDummyData(Generator $faker,array $customValue = array())
	{
		return [
			'name' => $faker->name,
			'email' => $faker->unique()->email,
			'password' => bcrypt('123123'),
			'type' => 'User',
		];
	}

	public function run()
	{
		$this->createAdmin();
		$this->createMultiple(50);
	}
	
	private function createAdmin()
	{
		$this->create([
			'name' => 'Juan Sebastian Leon Cadena',
			'email' => 'juansleonc@gmail.com',
			'password' => bcrypt('qwerty123'),
			'type' => 'Admin',
		]);
	}
}