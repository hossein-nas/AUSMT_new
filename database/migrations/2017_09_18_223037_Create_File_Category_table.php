<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileCategoryTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullabl(false);
            $table->string('base_dir_path', 500)->unique()->nullable(false);
            $table->string('dir_name', 30)->nullable(false);
            $table->boolean('removable')->nullable(false)->default(1);
            $table->string('description', 200)->nullable();
            $table->integer('parent_category_id')->unsigned()->nullable();
            $table->timestamps();
        });

        // add recursive Foregin key for "Parent Category"
        Schema::table('au_file_category', function (Blueprint $table) {
            $table->foreign('parent_category_id')
                ->references('id')
                ->on('au_file_category');
        });

        // adding some neccessary initial tuples
        $tuples = [
            [
                'name' => 'فایل‌ها',
                'base_dir_path' => '/files',
                'dir_name' => 'files',
                'removable' => 0
            ],
            [
                'name' => 'تصاویر',
                'base_dir_path' => '/files/images',
                'dir_name' => 'images',
                'removable' => 0,
                'parent_category_id' => 1
            ],
            [
                'name' => 'ویدئوها',
                'base_dir_path' => '/files/videos',
                'dir_name' => 'videos',
                'removable' => 0,
                'parent_category_id' => 1
            ],
            [
                'name' => 'صوت‌ها',
                'base_dir_path' => '/files/audios',
                'dir_name' => 'audios',
                'removable' => 0,
                'parent_category_id' => 1
            ],
            [
                'name' => 'اسناد',
                'base_dir_path' => '/files/docs',
                'dir_name' => 'docs',
                'removable' => 0,
                'parent_category_id' => 1
            ],
            [
                'name' => 'متفرقه',
                'base_dir_path' => '/files/misc',
                'dir_name' => 'misc',
                'removable' => 0,
                'parent_category_id' => 1
            ],

        ];
        foreach ($tuples as $tuple):
            DB::table('au_file_category')->insert($tuple);
            Storage::disk('public')->makeDirectory($tuple['base_dir_path']);
            $gitignore_file = <<<EOD
*
!.gitignore
EOD;
            Storage::disk('public')->put($tuple['base_dir_path'] . '/.gitignore', $gitignore_file);
        endforeach;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_category');
    }
}
