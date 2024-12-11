<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Carousel;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@cl.co',
            'password' => Hash::make('admin')
        ]);


        Carousel::create([
            'name' => 'First Carousel',
            'image_name' => 'car1.jpg',
            'description' => 'Description for the first carousel image.',
        ]);

        Carousel::create([
            'name' => 'Second Carousel',
            'image_name' => 'building2.jpg',
            'description' => 'Description for the second carousel image.',
        ]);

        Carousel::create([
            'name' => 'Third Carousel',
            'image_name' => 'building3.jpg',
            'description' => 'Description for the third carousel image.',
        ]);

        Contact::create([
            'office_no' => '(022) 812 3456 7890',
            'phone_number' => '0857 2303 6868',
            'email' => 'marketing@cyberlabs.co.id',
            'main_office_name' => 'Jl. Terusan Mars Utara III No. 8D Kota Bandung, 40292',
            'nat_branch_office' => 'Ariobimo Sentral level 8. Jalan H. R. Rasuna Said Kav X-2 No. 5. Kuningan timur, Setiabudi, Jakarta Selatan, 40292',
            'inter_branch_office' => 'Fragrance Empire, 456 Alexandra Road, #04-02, Singapore',
            'main_office' => [
                'lat' => 6.9432,
                'lng' => 107.6640
            ]
        ]);
    }
}
