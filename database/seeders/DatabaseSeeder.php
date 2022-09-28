<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Flight;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make("09022421741");
      $user = User::factory()->create([
         'name' =>'John DOe',
         'email' =>'john@gmail.com',
         'password' => $password
      ]);

        Listing::factory(5)->create([
            'user_id' => $user->id
        ]);
        // Flight::factory(15) ->create();
        // Flight::factory(5) ->create();
        // Listing::create([
            // 'title' => 'Laravel Senior Developer',
            // 'tags' => 'laravel, javascript',
            // 'company' => 'Acme Corp',
            // 'location' => 'Boston, MA',
            // 'email' => 'email@email.com',
            // 'website' => 'https://www.acme.com',
            // 'description' => 'Lorem ksussoiussusousous
            //  uusuosusuusuodsu Lorem ksussoiussusousous
            //  uusuosusuusuodsuLorem ksussoiussusousous
            //  uusuosusuusuodsuLorem ksussoiussusousous
            //  uusuosusuusuodsuLorem ksussoiussusousous
            //  uusuosusuusuodsu?'
        // ]);
        // Listing::create([
        //     'title' => 'Full-Stack Engineer',
        //     'tags' => 'laravel, backend, api',
        //     'company' => 'Became Cors',
        //     'location' => 'Boston, MA',
        //     'email' => 'emailss@email.com',
        //     'website' => 'https://www.became.com',
        //     'description' => 'Lorem ksussoiussusousous
        //      uusuosusuusuodsu Lorem ksussoiussusousous
        //      uusuosusuusuodsuLorem ksussoiussusousous
        //      uusuosusuusuodsuLorem ksussoiussusousous
        //      uusuosusuusuodsuLorem ksussoiussusousous
        //      uusuosusuusuodsu?'
        // ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
