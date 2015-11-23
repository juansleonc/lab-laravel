<?php

use Faker\Generator;
use TeachMe\Entities\Ticket;

class TicketTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new Ticket();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'title' => $faker->sentence(),
            'status' => $faker->randomElement(['open', 'closed']),
            // 'user_id' => rand(1, 51);
            // 'user_id' => $this->createFrom('UsersTableSeeder')->id,
            'user_id' => $this->getRandom('User')->id,
        ];
    }

    public function run()
    {
        $this->createMultiple(150);
    }
}
