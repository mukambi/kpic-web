<?php

use App\Icon;
use Illuminate\Database\Seeder;

class IconsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons = json_decode(file_get_contents(
            database_path('data/icons.json')
        ));

        foreach ($icons as $icon){
            Icon::create([
                'code' => $icon->code,
                'name' => $icon->name,
                'image_url' => $icon->image_url
            ]);
        }
    }
}
