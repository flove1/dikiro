<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        User::factory(5)->create();
        Item::factory(10)->create();
        $this->command->info('User table seeded!');
  }
}