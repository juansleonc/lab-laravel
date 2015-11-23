<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateTables([
            'password_resets',
            'ticket_votes',
            'ticket_comments',
            'tickets',
            'users',
        ]);

        $this->call('UsersTableSeeder');
        $this->call('TicketTableSeeder');
        $this->call('TicketVoteTableSeeder');
        $this->call('TicketCommentTableSeeder');

        Model::reguard();
    }
    public function truncateTables(array $tables)
    {
        $this->changeForeignKeys(false);
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        $this->changeForeignKeys(true);
    }
    public function changeForeignKeys($check)
    {
        $check = $check ? '1' : '0';
        DB::statement('SET FOREIGN_KEY_CHECKS = '.$check);
    }
}
