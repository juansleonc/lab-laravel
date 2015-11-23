<?php

use Faker\Generator;
use TeachMe\Entities\TicketComment;

class TicketCommentTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new TicketComment();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'user_id' => $this->getRandom('User')->id,
            'ticket_id' => $this->getRandom('Ticket')->id,
            'comment' => $faker->paragraph(),
            'link' => $faker->randomElement(['', '', $faker->url]),
        ];
    }

    public function run()
    {
        $this->createMultiple(150);
    }
}
