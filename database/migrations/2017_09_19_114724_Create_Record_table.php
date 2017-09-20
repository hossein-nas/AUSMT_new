<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('au_record', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 150)->nullable(false);
			$table->string('title_seo', 150)->unique()->nullable(false);
			
			// foreign key column
			$table->integer('record_type_id')->unsigned()->nullable(false);
			$table->integer('thumbnail_id')->unsigned()->nullable(false);
			$table->integer('user_id')->unsigned()->nullable(false);
			$table->integer('lang_id')->unsigned()->nullable(false);
			$table->timestamps();
		});
		
		// create "Record Type" table just here for simplicity (2 table in 1 file :) )
		Schema::create('au_record_type', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->nullable(false);
			$table->string('name_fa', 100)->nullable(false);
			$table->integer('parent_record_type_id')->unsigned()->nullable();
		});
		
		//add foreign key to 'au_record_type' recursively for parent child relation
		Schema::table('au_record_type', function (Blueprint $table){
			$table->foreign('parent_record_type_id')
				->references('id')
				->on('au_record_type');
		});
		
		//populating some initial tuples to record type table
		DB::table('au_record_type')->insert([
			[
				'name' => 'post',
				'name_fa' => 'پست',
				'parent_record_type_id' => null
			],
			[
				'name' => 'page',
				'name_fa' => 'برگه',
				'parent_record_type_id' => null
			],
			[
				'name' => 'mag_pub',
				'name_fa' => 'مجله و نشریات',
				'parent_record_type_id' => null
			],
			[
				'name' => 'news',
				'name_fa' => 'خبر',
				'parent_record_type_id' => 1
			],
			[
				'name' => 'notification',
				'name_fa' => 'اطلاعیه',
				'parent_record_type_id' => 1
			],
			[
				'name' => 'incoming_event',
				'name_fa' => 'پیشآمد',
				'parent_record_type_id' => 1
			],
			[
				'name' => 'seminar',
				'name_fa' => 'همایش و سمینار',
				'parent_record_type_id' => 1
			],
			[
				'name' => 'uncategorised',
				'name_fa' => 'متفرقه',
				'parent_record_type_id' => 1
			],
			[
				'name' => 'simple',
				'name_fa' => 'برگه ساده',
				'parent_record_type_id' => 2
			],
			[
				'name' => 'complex',
				'name_fa' => 'برگه پیشرفته',
				'parent_record_type_id' => 2
			],
			[
				'name' => 'profile',
				'name_fa' => 'پروفایل',
				'parent_record_type_id' => 2
			],
			[
				'name' => 'mag',
				'name_fa' => 'مجله',
				'parent_record_type_id' => 3
			],
			[
				'name' => 'publication',
				'name_fa' => 'نشریه',
				'parent_record_type_id' => 3
			],
			
		]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('au_record_type');
		Schema::drop('au_record');
	}
}
