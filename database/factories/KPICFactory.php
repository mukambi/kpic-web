<?php

/** @var Factory $factory */

use App\Icon;
use App\Patient;
use App\Sep;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Patient::class,
    function (Faker $faker) {
        $sep = Sep::query()->inRandomOrder()->first();
        $surname = $faker->firstName . rand(10,99);
        $first_name = $faker->firstName . rand(10,99);
        $second_name = $faker->firstName . rand(10,99);
        $yob = rand(1930, (int) date('Y'));
        $mob = 'April';
        $admin = User::query()->where('email', 'admin@example.com')->first();
        $icon = Icon::orderBy('name')->limit(4)->first();
        if (is_null($second_name)) $second_name = '0000';
        $user_data_code = (string)implode('|', [
            strtoupper($surname),
            strtoupper($first_name),
            strtoupper($second_name),
            $yob,
            strtoupper($mob)
        ]);
        $concatenated_string = (string)implode("-", [
            $user_data_code
        ]);

        $kpicChars = [
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "A", "B", "C", "D", "E", "F", "G", "H", "J", "K",
            "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V",
            "W", "X", "Y", "Z"
        ];
        $hash = hash('sha256', $concatenated_string);
        $buff = [];
        for ($i = 0; $i < 9; $i++) {
            $b = (int)hexdec($hash[$i]);
            if ($b < 0) $b += 256;
            $idx = (int)$b % count($kpicChars);
            array_push($buff, $kpicChars[$idx]);
        }
        $kpic_code = (string)implode('', $buff);
        return [
            'sep_id' => $sep->id,
            'icon_id' => $icon->id,
            'kpic_code' => $kpic_code,
            'possible_duplicate' => false,
            'creator_id' => $admin->id
        ];
    });
