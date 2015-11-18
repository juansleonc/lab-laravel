<?php
use Faker\Generator;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use \Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends Seeder
{

	protected static $pool = array();

	protected function createMultiple($total, array $customValue = array()){
		for ($i=0; $i < $total; $i++) { 
			$this->create($customValue);
		}
	}

	abstract public function getModel();
	
	abstract public function getDummyData(Generator $faker, array $customValue = array());

	protected function create(array $customValue = array())
	{
		$values = $this->getDummyData(Faker::create(),$customValue);
		$values = array_merge($values, $customValue);
		return $this->addToPool($this->getModel()->create($values));
	}
	protected function createFrom($seeder, array $customValue = array())
	{
		$seeder = new $seeder;
		return $seeder->create($customValue);
	}
	protected function getRandom($model)
	{
		if ( ! isset(static::$pool[$model]))
		{
			throw new Exception("The $model collection does not exists");
			
		}
		return static::$pool[$model]->random();
	}
	private function addToPool($entity)
	{
		$reflection = new ReflectionClass($entity);
		// $class = get_class($entity);
		$class = $reflection->getShortName();

		if ( ! isset(static::$pool[$class]) ) {
			static::$pool[$class] = new Collection();
		}

		static::$pool[$class]->add($entity);

		return $entity;
	}
}