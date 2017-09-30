<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_user_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_title',50)->nullable(false);
            $table->string('role_title_en',50)->nullable(false);
            $table->integer('parent_role')->unsigned()->nullable();
            $table->boolean('removable')->nullable(false)->default(1);
            $table->text('description');
        });

        Schema::table('au_user_type', function(Blueprint $table){
            $table->foreign('parent_role')
                ->references('id')
                ->on('au_user_type');
        });

        $tuples = [
            [
                'id' => 1, 'parent_role' => null, 'removable' => 0,
                'role_title' => 'مدیرکل', 'role_title_en' => 'Admin',
                'description' => 'نقش مدیر کل دارای تمامی اختیارات می‌باشد. همچنین فقط یک مدیر کل وجود دارد و نمی‌توان کاربر جدیدی با عنوان مدیر کل ایجاد کرد. بالاترین مرتبه بعد از مدیر کل مدیر سیستم می‌باشد.'
            ],
                [
                    'id' => 2, 'parent_role' => 1, 'removable' => 0,
                    'role_title' => 'مدیر سیستم', 'role_title_en' => 'Manager',
                    'description' => 'نقش مدیر سیستم تقریبا اختیاراتی مشابه مدیر کل دارد با این تفاوت که قادر نخواهد بود که کاربری را حذف کند.'
                ],
                    [
                        'id' => 4, 'parent_role' => 2, 'removable' => 0,
                        'role_title' => 'مدیر بخش کاربران', 'role_title_en' => 'User manager',
                        'description' => 'نقش مدیر بخش کاربران قادر خواهد بود کاربران سیستم را مدیریت کند. این نقش زیرمجموعه مدیر سیستم می‌باشد و مشاهده، افزودن، ویرایش، تغییر نقش کاربران تنها اختیاراتی هستند که مدیر بخش کاربران قادر به انجام آن‌ها خواهد بود.'
                    ],
                    [
                        'id' => 5, 'parent_role' => 2, 'removable' => 0,
                        'role_title' => 'مدیر فایل‌ها', 'role_title_en' => 'File Manager',
                        'description' => 'نقش مدیر فایل‌ها قادر خواهد بود فایل‌های سیستم را مدیریت کند. این نقش زیرمجموعه مدیر سیستم می‌باشد و مشاهده، افزودن، ویرایش، ویرایش مشخصات فایل‌ها و مدیریت دسته بندی فایل‌ها تنها اختیاراتی هستند که مدیر فایل‌ها قادر به انجام آن‌ها خواهد بود.'
                    ],
                    [
                        'id' => 6, 'parent_role' => 2, 'removable' => 0,
                        'role_title' => 'مدیر بخش دیدگاه‌ها', 'role_title_en' => 'Comments manager',
                        'description' => 'نقش مدیر بخش دیدگاه‌ها قادر خواهد بود دیدگاه‌های سیستم را مدیریت کند. این نقش زیرمجموعه مدیر سیستم می‌باشد و مشاهده، ارسال، ویرایش، تأیید، حذف دیدگاه‌ها تنها اختیاراتی هستند که مدیر بخش دیدگاه‌ها قادر به انجام آن‌ها خواهد بود.'
                    ],
                    [
                        'id' => 7, 'parent_role' => 2, 'removable' => 0,
                        'role_title' => 'مدیر بخش‌های سازمانی', 'role_title_en' => 'Org manager',
                        'description' => 'نقش مدیر بخش‌های سازمانی قادر خواهد بود بخش‌های سازمانی سیستم از جمله واحد‌های سازمانی، نقش‌های سازمانی، ساختمان‌ها و اشخاص را مدیریت کند. این نقش زیرمجموعه مدیر سیستم می‌باشد'
                    ],
                [
                    'id' => 3, 'parent_role' => 1, 'removable' => 0,
                    'role_title' => 'نویسنده', 'role_title_en' => 'writer',
                    'description' => 'نقش نویسنده قادر خواهد بود نوشته های سیستم را مشاهده و مدیریت کند، اسلایدر، نوار منو و منو دسترسی سریع را نیز می‌تواند مدیریت کند. همچنین قادر به ارسال دیدگاه نیز خواهد بود. این نقش زیرمجموعه مدیر سیستم می‌باشد.'
                ],
                    [
                        'id' => 8, 'parent_role' => 3, 'removable' => 0,
                        'role_title' => 'نویسنده ساده', 'role_title_en' => 'Basic wirter',
                        'description' => 'نقش نویسنده ساده قادر خواهد بود پست‌هایی را به سیستم ارسال و ویرایش کند ولی قادر به حذف پست ها نخواهد بود. همچنین قادر به ارسال دیدگاه نیز خواهد بود. این نقش زیرمجموعه نقش نویسنده می‌باشد.'
                    ],
                    [
                        'id' => 9, 'parent_role' => 3, 'removable' => 0,
                        'role_title' => 'مجله نویس', 'role_title_en' => 'Mag writer',
                        'description' => 'نقش مجله نویس قادر خواهد بود مجله‌ها را به سیستم ارسال و ویرایش کند. این نقش زیرمجموعه نقش نویسنده می‌باشد.'
                    ],
                    [
                        'id' => 10, 'parent_role' => 3, 'removable' => 0,
                        'role_title' => 'برگه نویس', 'role_title_en' => 'Page writer',
                        'description' => 'نقش برگه نویس قادر خواهد بود برگه‌ها را به سیستم ارسال و ویرایش کند ولی قادر به حذف برگه‌ها نخواهد بود. همچنین قادر به مدیریت نوار منو و منو دسترسی سریع نیز خواهد بود. این نقش زیرمجموعه نقش نویسنده می‌باشد. '
                    ]
        ];
        // insert some intial tuple to 'au_user_type' table
        DB::table('au_user_type')->insert($tuples);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_user_type');
    }
}
