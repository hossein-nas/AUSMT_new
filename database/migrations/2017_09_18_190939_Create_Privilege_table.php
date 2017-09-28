<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_privilege', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_name')->index()->unique()->nullable(false);;
            $table->string('privilege_name', 50)->nullable(false);
            $table->string('privilege_name_en', 50)->nullable(false);
            $table->integer('parent_privilege')->unsigned()->nullable();
            $table->integer('privilege_dependency')->unsigned()->nullable();
            $table->string('description', 250)->nullable(false);
        });

        Schema::table('au_privilege', function (Blueprint $table) {
            $table->foreign('parent_privilege')
                ->references('id')
                ->on('au_privilege');
        });

        $tuples = [
            [
                'id' => 1, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewRecords', 'privilege_name_en' => 'View records',
                'privilege_name' => 'مشاهده‌ی نوشته‌ها',
                'description' => 'با این اختیار قادر به مشاهده انواع نوشته (از جمله: خبر، اطلاعیه، برگه، مجله و ...) خواهید بود.'
            ],
                [
                    'id' => 2, 'parent_privilege' => 1, 'privilege_dependency' => null,
                    'id_name' => 'viewPosts', 'privilege_name_en' => 'View posts',
                    'privilege_name' => 'مشاهده پست‌ها',
                    'description' => 'با این اختیار قادر خواهید بود پست‌های سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
                ],
                [
                    'id' => 3, 'parent_privilege' => 1, 'privilege_dependency' => null,
                    'id_name' => 'viewPages', 'privilege_name_en' => 'View pages',
                    'privilege_name' => 'مشاهده برگه‌ها',
                    'description' => 'با این اختیار قادر خواهید بود برگه‌های سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
                ],
                [
                    'id' => 4, 'parent_privilege' => 1, 'privilege_dependency' => null,
                    'id_name' => 'viewMags', 'privilege_name_en' => 'View magazines',
                    'privilege_name' => 'مشاهده مجلات',
                    'description' => 'با این اختیار قادر خواهید بود مجلات و نشریات سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
                ],
            [
                'id' => 5, 'parent_privilege' => null, 'privilege_dependency' => 1,
                'id_name' => 'manageRecords', 'privilege_name_en' => 'Manage records',
                'privilege_name' => 'مدیریت نوشته‌ها',
                'description' => 'با این اختیار قادر به حذف، ویرایش و افزودن انواع نوشته (از جمله: خبر، اطلاعیه، برگه، مجله و ...) خواهید بود.'
            ],
                [
                    'id' => 6, 'parent_privilege' => 5, 'privilege_dependency' => 2,
                    'id_name' => 'managePosts', 'privilege_name_en' => 'Manage posts',
                    'privilege_name' => 'مدیریت پست‌ها',
                    'description' => 'با این اختیار قادر به حذف، ویرایش و افزودن هر انواع پست‌ها (خبر، اطلاعیه، سمینار، پیشآمد) خواهید بود.'
                ],
                    [
                        'id' => 23, 'parent_privilege' => 6, 'privilege_dependency' => 2,
                        'id_name' => 'addNewPost', 'privilege_name_en' => 'Add new post',
                        'privilege_name' => 'افزودن پست جدید',
                        'description' => 'با این اختیار قادر خواهید بود پست‌های مختلفی (خبر، اطلاعیه، پیشآمد، سمینار و متفرقه) به سیستم وارد کنید. توجه داشته باشید با داشتن این اختیار فقط حق ایجاد پست جدید را خواهید داشت و حق ویرایش یا حذف نخواهید داشت.'
                    ],
                    [
                        'id' => 24, 'parent_privilege' => 6, 'privilege_dependency' => 2,
                        'id_name' => 'deletePosts', 'privilege_name_en' => 'Delete posts',
                        'privilege_name' => 'حذف پست‌ها',
                        'description' => 'با این اختیار قادر خواهید بود پست‌های سیستم را حذف کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا ویرایش پست‌ها را نخواهید داشت.'
                    ],
                    [
                        'id' => 25, 'parent_privilege' => 6, 'privilege_dependency' => 2,
                        'id_name' => 'editPosts', 'privilege_name_en' => 'Edit posts',
                        'privilege_name' => 'ویرایش پست‌ها',
                        'description' => 'با این اختیار قادر خواهید بود پست‌های سیستم را ویرایش کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا حذف پست‌ها را نخواهید داشت.'
                    ],

                [
                    'id' => 7, 'parent_privilege' => 5, 'privilege_dependency' => 3,
                    'id_name' => 'managePages', 'privilege_name_en' => 'Manage pages',
                    'privilege_name' => 'مدیریت برگه‌ها',
                    'description' => 'با این اختیار قادر به حذف، ویرایش و افزودن هر انواع برگه‌ها (برگه ساده یا برگه پیچیده) خواهید بود.'
                ],
                    [
                        'id' => 26, 'parent_privilege' => 7, 'privilege_dependency' => 3,
                        'id_name' => 'addNewPage', 'privilege_name_en' => 'Add new pages',
                        'privilege_name' => 'افزودن برگه جدید',
                        'description' => 'با این اختیار قادر خواهید بود برگه (برگه ساده یا پیچیده) به سیستم اضافه کنید. توجه داشته باشید با داشتن این اختیار فقط حق ایجاد برگه جدید را خواهید داشت و حق ویرایش یا حذف نخواهید داشت.'
                    ],
                    [
                        'id' => 27, 'parent_privilege' => 7, 'privilege_dependency' => 3,
                        'id_name' => 'deletePages', 'privilege_name_en' => 'Delete pages',
                        'privilege_name' => 'حذف برگه‌ها',
                        'description' => 'با این اختیار قادر خواهید بود برگه‌های سیستم را حذف کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا ویرایش برگه‌ها را نخواهید داشت.'
                    ],
                    [
                        'id' => 28, 'parent_privilege' => 7, 'privilege_dependency' => 3,
                        'id_name' => 'editPages', 'privilege_name_en' => 'Edit pages',
                        'privilege_name' => 'ویرایش برگه‌ها',
                        'description' => 'با این اختیار قادر خواهید بود برگه‌ها سیستم را ویرایش کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا حذف برگه‌ها را نخواهید داشت.'
                    ],
                [
                    'id' => 8, 'parent_privilege' => 5, 'privilege_dependency' => 4,
                    'id_name' => 'manageMags', 'privilege_name_en' => 'Manage magazines',
                    'privilege_name' => 'مدیریت مجلات',
                    'description' => 'با این اختیار قادر به حذف، ویرایش و افزودن هر انواع مجلات (مجله یا نشریه) خواهید بود.'
                ],
                    [
                        'id' => 29, 'parent_privilege' => 8, 'privilege_dependency' => 4,
                        'id_name' => 'addNewMag', 'privilege_name_en' => 'Add new pages',
                        'privilege_name' => 'افزودن مجله جدید',
                        'description' => 'با این اختیار قادر خواهید بود  مجله یا نشریه جدید به سیستم اضافه کنید. توجه داشته باشید با داشتن این اختیار فقط حق افزودن مجله یا نشریه را خواهید داشت و حق ویرایش یا حذف نخواهید داشت.'
                    ],
                    [
                        'id' => 30, 'parent_privilege' => 8, 'privilege_dependency' => 4,
                        'id_name' => 'deleteMags', 'privilege_name_en' => 'Delete magazines',
                        'privilege_name' => 'حذف مجلات',
                        'description' => 'با این اختیار قادر خواهید بود مجلات یا نشریات سیستم را حذف کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا ویرایش مجلات را نخواهید داشت.'
                    ],
                    [
                        'id' => 31, 'parent_privilege' => 8, 'privilege_dependency' => 4,
                        'id_name' => 'editMags', 'privilege_name_en' => 'Edit magazines',
                        'privilege_name' => 'ویرایش مجلات',
                        'description' => 'با این اختیار قادر خواهید بود مجلات یا نشریات سیستم را ویرایش کنید. توجه داشته باشید با داشتن این اختیار، حق ایجاد یا حذف برگه‌ها را نخواهید داشت.'
                    ],
            [
                'id' => 9, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'manageSlider', 'privilege_name_en' => 'Manage slider',
                'privilege_name' => 'مدیریت اسلایدر',
                'description' => 'با این اختیار قادر خواهید بود اسلایدر جدیدی به سیستم اضافه کنید یا اسلایدرهای قبلی را حذف و ویرایش کنید.'
            ],
            [
                'id' => 10, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'manageNavbar', 'privilege_name_en' => 'Manage navigation bar',
                'privilege_name' => 'مدیریت نوار منو',
                'description' => 'با این اختیار قادر خواهید بود نوار منوی سیستم را شخصی سازی کنید، آیتم جدیدی اضافه کنید، حذف کنید و ویرایش کنید.'
            ],
            [
                'id' => 11, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'manageFastmenu', 'privilege_name_en' => 'Manage fast access menu',
                'privilege_name' => 'مدیریت منو دسترسی سریع',
                'description' => 'با این اختیار قادر خواهید بود منو دسترسی سریع را شخصی سازی کنید، مورد جدید اضافه کنید، موارد قبلی را حذف و ویرایش کنید.'
            ],
            [
                'id' => 12, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewComments', 'privilege_name_en' => 'View comments',
                'privilege_name' => 'مشاهده دیدگاه‌‌ها',
                'description' => 'با این اختیار قادر خواهید بود کامنت‌های سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 13, 'parent_privilege' => null, 'privilege_dependency' => 12,
                'id_name' => 'viewComment', 'privilege_name_en' => 'View comment',
                'privilege_name' => 'مشاهده دیدگاه‌ با جزئیات',
                'description' => 'با این اختیار قادر خواهید بود کامنت‌های سیستم را بصورت تکی با جزئیات بیشتری مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 14, 'parent_privilege' => null, 'privilege_dependency' => 12,
                'id_name' => 'manageComments', 'privilege_name_en' => 'Manage comments',
                'privilege_name' => 'مدیریت دیدگاه‌ها',
                'description' => 'با این اختیار قادر خواهید بود دیدگاه‌ها را تأیید، حذف، ویرایش کنید و حتی دیدگاه جدید ارسال کنید.'
            ],
                [
                    'id' => 32, 'parent_privilege' => 14, 'privilege_dependency' => 12,
                    'id_name' => 'verifyComments', 'privilege_name_en' => 'Verify comments',
                    'privilege_name' => 'تأیید دیدگاه‌ها',
                    'description' => 'با این اختیار قادر خواهید بود دیدگاه‌های جدیدی که ارسال می‌شوند را به عنوان مدیر تأیید کنید. توجه داشته باشید با این اختیار فقط می‌توانید تأیید کنید ویرایش یا حتی حذف دیدگاه ارسال شده از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 33, 'parent_privilege' => 14, 'privilege_dependency' => 12,
                    'id_name' => 'addNewComment', 'privilege_name_en' => 'Add new comment',
                    'privilege_name' => 'افزودن دیدگاه جدید',
                    'description' => 'با این اختیار قادر خواهید بود که دیدگاه جدیدی را ارسال کنید. این دیدگاه می‌تواند در پاسخ به پرسش کاربران یا به صورت اختیاری مورد پست‌ها ارسال بشوند.'
                ],
                [
                    'id' => 34, 'parent_privilege' => 14, 'privilege_dependency' => 12,
                    'id_name' => 'deleteComments', 'privilege_name_en' => 'Delete comments',
                    'privilege_name' => 'حذف دیدگاه‌ها',
                    'description' => 'با این اختیار قادر خواهید بود دیدگاه‌ها را حذف کنید.'
                ],
                [
                    'id' => 35, 'parent_privilege' => 14, 'privilege_dependency' => 12,
                    'id_name' => 'editComments', 'privilege_name_en' => 'Edit comments',
                    'privilege_name' => 'ویرایش دیدگاه‌ها',
                    'description' => 'با این اختیار قادر خواهید بود دیدگاه‌ها را ویرایش کنید. توجه داشته باشید که با این اختیار قادر نخواهید بود که دیدگاه‌ها را تأیید کنید.'
                ],
            [
                'id' => 15, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewOrgUnits', 'privilege_name_en' => 'View organizational units',
                'privilege_name' => 'مشاهده‌ی واحدهای سازمانی',
                'description' => 'با این اختیار قادر خواهید بود سلسله مراتب واحد‌های سازمانی سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 16, 'parent_privilege' => null, 'privilege_dependency' => 16,
                'id_name' => 'manageOrgUnits', 'privilege_name_en' => 'Manage organizational units',
                'privilege_name' => 'مدیریت واحدهای سازمانی',
                'description' => 'با این اختیار قادر خواهید بود واحدهای سازمانی سیستم را حذف، ویرایش، سلسله مراتب را تغییر دهید و حتی می‌توانید واحد جدیدی را به سیستم اضافه کنید. '
            ],
                [
                    'id' => 36, 'parent_privilege' => 16, 'privilege_dependency' => 15,
                    'id_name' => 'changeOrgUnitHierarchy', 'privilege_name_en' => 'Change organizational unit hierarchy',
                    'privilege_name' => 'تغییر سلسله مراتب واحدهای سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود سلسله مراتب واحدهای سازمانی را تغییر دهید. باید توجه داشته باشید با این اختیار قادر به ویرایش مشخصات واحد‌های سازمانی نخواهید بود.'
                ],
                [
                    'id' => 37, 'parent_privilege' => 16, 'privilege_dependency' => 15,
                    'id_name' => 'addNewOrgUnit', 'privilege_name_en' => 'Add new organizational unit',
                    'privilege_name' => 'افزودن واحد سازمانی جدید',
                    'description' => 'با این اختیار قادر خواهید بود واحد سازمانی جدیدی به سیستم اضافه کنید. ولی حذف، ویرایش یا تغییر سلسله مراتب واحدهای سازمانی از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 38, 'parent_privilege' => 16, 'privilege_dependency' => 15,
                    'id_name' => 'deleteOrgUnits', 'privilege_name_en' => 'Delete organizational units',
                    'privilege_name' => 'حذف واحدهای سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود واحدهای سازمانی سیستم را حذف کنید.'
                ],
                [
                    'id' => 39, 'parent_privilege' => 16, 'privilege_dependency' => 15,
                    'id_name' => 'editOrgUnits', 'privilege_name_en' => 'Edit organizational units',
                    'privilege_name' => 'ویرایش مشخصات واحدهای سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود مشخصات واحدهای سازمانی را ویرایش کنید. باید توجه داشته باشید که با این اختیار قادر نخواهید بود که سلسله مراتب واحد‌های سازمانی را تغییر بدهید.'
                ],
            [
                'id' => 17, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewOrgRoles', 'privilege_name_en' => 'View organizational roles',
                'privilege_name' => 'مشاهده‌ی نقش‌های سازمانی',
                'description' => 'با این اختیار قادر خواهید بود سلسله مراتب نقش‌های سازمانی سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 18, 'parent_privilege' => null, 'privilege_dependency' => 17,
                'id_name' => 'manageOrgRoles', 'privilege_name_en' => 'Manage organizational roles',
                'privilege_name' => 'مدیریت نقش‌های سازمانی',
                'description' => 'با این اختیار قادر خواهید بود نقش‌های سازمانی سیستم را حذف، ویرایش، سلسله مراتب را تغییر دهید و حتی می‌توانید نقش جدیدی را به سیستم اضافه کنید. '
            ],
                [
                    'id' => 40, 'parent_privilege' => 18, 'privilege_dependency' => 17,
                    'id_name' => 'changeOrgRoleHierarchy', 'privilege_name_en' => 'Change organizational role hierarchy',
                    'privilege_name' => 'تغییر سلسله مراتب نقش‌های سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود سلسله مراتب نقش‌های سازمانی را تغییر دهید. باید توجه داشته باشید با این اختیار قادر به ویرایش مشخصات نقش‌های سازمانی نخواهید بود.'
                ],
                [
                    'id' => 41, 'parent_privilege' => 18, 'privilege_dependency' => 17,
                    'id_name' => 'addNewOrgRole', 'privilege_name_en' => 'Add new organizational role',
                    'privilege_name' => 'افزودن نقش سازمانی جدید',
                    'description' => 'با این اختیار قادر خواهید بود نقش سازمانی جدیدی به سیستم اضافه کنید. ولی حذف، ویرایش یا تغییر سلسله مراتب نقش‌های سازمانی از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 42, 'parent_privilege' => 18, 'privilege_dependency' => 17,
                    'id_name' => 'deleteOrgRoles', 'privilege_name_en' => 'Delete organizational roles',
                    'privilege_name' => 'حذف نقش‌های سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود نقش‌های سازمانی سیستم را حذف کنید.'
                ],
                [
                    'id' => 43, 'parent_privilege' => 18, 'privilege_dependency' => 17,
                    'id_name' => 'editOrgRoles', 'privilege_name_en' => 'Edit organizational roles',
                    'privilege_name' => 'ویرایش مشخصات نقش‌های سازمانی',
                    'description' => 'با این اختیار قادر خواهید بود مشخصات نقش‌های سازمانی را ویرایش کنید. باید توجه داشته باشید که با این اختیار قادر نخواهید بود که سلسله مراتب نقش‌های سازمانی را تغییر بدهید.'
                ],
            [
                'id' => 19, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewStructures', 'privilege_name_en' => 'View structures',
                'privilege_name' => 'مشاهده‌ی ساختمان‌های سیستم',
                'description' => 'با این اختیار قادر خواهید بود ساختمان‌های سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 20, 'parent_privilege' => null, 'privilege_dependency' => 19,
                'id_name' => 'manageStructures', 'privilege_name_en' => 'Manage structures',
                'privilege_name' => 'مدیریت ساختمان‌های سیستم',
                'description' => 'با این اختیار قادر خواهید بود ساختمان‌های سیستم را حذف، ویرایش و حتی می‌توانید ساختمان جدیدی را به سیستم اضافه کنید.'
            ],
                [
                    'id' => 44, 'parent_privilege' => 20, 'privilege_dependency' => 19,
                    'id_name' => 'changeStrutureNesting', 'privilege_name_en' => 'Change Structure Nesting',
                    'privilege_name' => 'تغییر ساختار تودرتو یی ساختمان‌ها',
                    'description' => 'با این اختیار قادر خواهید بود ساختار تودرتو یی ساختمان‌ها را تغییر دهید. باید توجه داشته باشید با این اختیار قادر به ویرایش مشخصات ساختمان‌ها نخواهید بود.'
                ],
                [
                    'id' => 45, 'parent_privilege' => 20, 'privilege_dependency' => 19,
                    'id_name' => 'addNewStructure', 'privilege_name_en' => 'Add new structure',
                    'privilege_name' => 'افزودن ساختمان جدید',
                    'description' => 'با این اختیار قادر خواهید بود ساختمان جدیدی به سیستم اضافه کنید. ولی حذف، ویرایش یا تغییر ساختار تودرتویی ساختمان‌ها از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 46, 'parent_privilege' => 20, 'privilege_dependency' => 19,
                    'id_name' => 'deleteStructures', 'privilege_name_en' => 'Delete structures',
                    'privilege_name' => 'حذف ساختمان‌ها',
                    'description' => 'با این اختیار قادر خواهید بود ساختمان‌های سیستم را حذف کنید.'
                ],
                [
                    'id' => 47, 'parent_privilege' => 20, 'privilege_dependency' => 19,
                    'id_name' => 'editStructures', 'privilege_name_en' => 'Edit Structure specs',
                    'privilege_name' => 'ویرایش مشخصات ساختمان‌ها',
                    'description' => 'با این اختیار قادر خواهید بود مشخصات ساختمان‌ها را ویرایش کنید. باید توجه داشته باشید که با این اختیار قادر نخواهید بود که ساختار تودرتو یی ساختمان‌ها را تغییر بدهید.'
                ],
            [
                'id' => 21, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewPeoples', 'privilege_name_en' => 'View peoples',
                'privilege_name' => 'مشاهده‌ی افراد سیستم',
                'description' => 'با این اختیار قادر خواهید بود افراد سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 22, 'parent_privilege' => null, 'privilege_dependency' => 21,
                'id_name' => 'managePeoples', 'privilege_name_en' => 'Manage peoples',
                'privilege_name' => 'مدیریت افراد سیستم',
                'description' => 'با این اختیار قادر خواهید بود افراد سیستم را حذف، ویرایش و حتی می‌توانید فرد جدیدی را به سیستم اضافه کنید.'
            ],
                [
                    'id' => 48, 'parent_privilege' => 22, 'privilege_dependency' => 21,
                    'id_name' => 'addNewPerson', 'privilege_name_en' => 'Add new person',
                    'privilege_name' => 'افزودن فرد جدید',
                    'description' => 'با این اختیار قادر خواهید بود فرد جدیدی به سیستم اضافه کنید. ولی حذف یا ویرایش مشخصات افراد از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 49, 'parent_privilege' => 22, 'privilege_dependency' => 21,
                    'id_name' => 'deletePersons', 'privilege_name_en' => 'Delete persons',
                    'privilege_name' => 'حذف افراد',
                    'description' => 'با این اختیار قادر خواهید بود افراد را از  سیستم حذف کنید.'
                ],
                [
                    'id' => 50, 'parent_privilege' => 22, 'privilege_dependency' => 21,
                    'id_name' => 'editPersons', 'privilege_name_en' => 'Edit persons specs',
                    'privilege_name' => 'ویرایش مشخصات افراد',
                    'description' => 'با این اختیار قادر خواهید بود مشخصات افراد را ویرایش کنید.'
                ],
            [
                'id' => 51, 'parent_privilege' => null, 'privilege_dependency' => null,
                'id_name' => 'viewUsers', 'privilege_name_en' => 'View users',
                'privilege_name' => 'مشاهده‌ی کاربران سیستم',
                'description' => 'با این اختیار قادر خواهید بود کاربران سیستم را مشاهده کنید. ولی قادر به اعمال تغییرات بروی آن‌ها نخواهید بود.'
            ],
            [
                'id' => 52, 'parent_privilege' => null, 'privilege_dependency' => 51,
                'id_name' => 'manageUsers', 'privilege_name_en' => 'Manage users',
                'privilege_name' => 'مدیریت کاربران سیستم',
                'description' => 'با این اختیار قادر خواهید بود کاربران سیستم را حذف، ویرایش و حتی می‌توانید کاربر جدیدی را به سیستم اضافه کنید.'
            ],
                [
                    'id' => 53, 'parent_privilege' => 52, 'privilege_dependency' => 51,
                    'id_name' => 'addNewUser', 'privilege_name_en' => 'Add new user',
                    'privilege_name' => 'افزودن کاربر جدید',
                    'description' => 'با این اختیار قادر خواهید بود کاربر جدیدی به سیستم اضافه کنید. ولی حذف یا ویرایش مشخصات کاربران از اختیار شما خارج خواهد بود.'
                ],
                [
                    'id' => 54, 'parent_privilege' => 52, 'privilege_dependency' => 51,
                    'id_name' => 'deleteUsers', 'privilege_name_en' => 'Delete users',
                    'privilege_name' => 'حذف کاربران',
                    'description' => 'با این اختیار قادر خواهید بود کاربران سیستم را حذف کنید.'
                ],
                [
                    'id' => 55, 'parent_privilege' => 52, 'privilege_dependency' => 51,
                    'id_name' => 'editUsers', 'privilege_name_en' => 'Edit users specs',
                    'privilege_name' => 'ویرایش مشخصات کاربران',
                    'description' => 'با این اختیار قادر خواهید بود مشخصات افراد را ویرایش کنید.'
                ],
                [
                    'id' => 56, 'parent_privilege' => 52, 'privilege_dependency' => 51,
                    'id_name' => 'updateUserPhoto', 'privilege_name_en' => 'Update user photo',
                    'privilege_name' => 'بروزرسانی تصویر کاربر',
                    'description' => 'با این اختیار قادر خواهید بود تصویر کاربر را بروزرسانی کنید.'
                ],

        ];
        DB::table('au_privilege')->insert($tuples);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_privilege');
    }
}
