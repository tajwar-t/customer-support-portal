<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@support.com',
                'password' => bcrypt('agent123'),
                'role' => 'support_agent',
            ],
            [
                'name' => 'Mike Davis',
                'email' => 'mike@support.com',
                'password' => bcrypt('agent123'),
                'role' => 'support_agent',
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma@support.com',
                'password' => bcrypt('agent123'),
                'role' => 'support_agent',
            ],
        ];

        foreach ($agents as $agent) {
            User::firstOrCreate(
                ['email' => $agent['email']],
                $agent
            );
        }
    }
}
