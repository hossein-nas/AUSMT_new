<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\Models\Navigationbar::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->realText(20, 4),
        'uri' => $faker->url,
        'lang_id' => 1,
        'prev' => null,
        'parent_id' => null,
        'navbar_type_id' => 1,
    ];
});
$factory->define(App\Models\Fastmenu::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->realText(20, 4),
        'uri' => $faker->url,
        'lang_id' => 1,
        'prev' => null,
        'svg_icon_id' => function () {
            $a = factory(App\Models\Files\File::class)->create(['extension_id' => 5]);
            factory(App\Models\Files\File_MultiValue::class)->create(['related_file_id' => $a->id]);
            return $a->id;
        }
    ];
});
$factory->define(App\Models\Users\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'user_type_id' => rand(1, 10),
        'thumbnail_id' => null,
    ];
});

$factory->define(App\Models\Files\File::class, function (Faker\Generator $faker) {
    return [
        'orig_name' => $faker->name,
        'name' => $faker->userName,
        'title' => $faker->text(10),
        'description' => $faker->realText(),
        'responsive_image' => 0,
        'extension_id' => rand(1, 3),
        'file_category_id' => 2,
    ];
});

$factory->define(App\Models\Files\File_MultiValue::class, function (Faker\Generator $faker) {
    $width = 480;
    $height = 480 * 1.6;
    $ratio = $height / ($width * 1.0);
    return [
        'related_file_id' => null,
        'file_fullpath' => $faker->imageUrl($width, $height, 'nature'),
        'filesize' => rand(100, 200),
        'height' => $height,
        'width' => $width,
        'ratio' => $ratio,
    ];
});

$factory->define(App\Models\Files\File_Group::class, function () {
    return [
        'title' => null,
        'file_group_type_id' => null,
        'record_id' => null
    ];
});

$factory->define(App\Models\Files\Gallery::class, function () {
    return [
        'id' => null,
        'description' => null
    ];
});

