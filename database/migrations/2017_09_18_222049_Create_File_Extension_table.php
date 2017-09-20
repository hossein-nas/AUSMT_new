<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileExtensionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('au_file_extension', function (Blueprint $table) {
            $table->increments('id');
	        $table->string('extension',5)->nullable(false);
	        $table->string('mimetype',100)->nullable(false);
	        $table->integer('file_type_id')->unsigned();
        });
	    
	    //adding "file_type_id" foreign key to table
	    Schema::table('au_file_extension', function(Blueprint $table){
	    	$table->foreign('file_type_id')
			    ->references('id')
			    ->on('au_file_type');
	    });
	    
	    $tuples = [
	    	// Images
		    [
			    'extension' => 'jpeg',
			    'mimetype' => 'image/jpeg',
			    'file_type_id' => 1
		    ],
		    [
			    'extension' => 'jpg',
			    'mimetype' => 'image/jpeg',
			    'file_type_id' => 1
		    ],
		    [
			    'extension' => 'png',
			    'mimetype' => 'image/png',
			    'file_type_id' => 1
		    ],
		    [
			    'extension' => 'gif',
			    'mimetype' => 'image/gif',
			    'file_type_id' => 1
		    ],
		    [
			    'extension' => 'svg',
			    'mimetype' => 'image/svg+xml',
			    'file_type_id' => 1
		    ],
		
		
		    
		    // Videos
		    [
			    'extension' => 'flv',
			    'mimetype' => 'video/x-flv',
			    'file_type_id' => 2
		    ],
		    [
			    'extension' => 'mp4',
			    'mimetype' => 'video/mp4',
			    'file_type_id' => 2
		    ],
		    [
			    'extension' => 'wmv',
			    'mimetype' => 'video/x-ms-wmv',
			    'file_type_id' => 2
		    ],
		    [
			    'extension' => 'avi',
			    'mimetype' => 'video/avi',
			    'file_type_id' => 2
		    ],
		    [
			    'extension' => 'mkv',
			    'mimetype' => 'video/x-matroska',
			    'file_type_id' => 2
		    ],
		    [
			    'extension' => 'mov',
			    'mimetype' => 'video/quicktime',
			    'file_type_id' => 2
		    ],
		
			// Audios
		    [
			    'extension' => 'mp3',
			    'mimetype' => 'audio/mpeg',
			    'file_type_id' => 3
		    ],
		    [
			    'extension' => 'mp4',
			    'mimetype' => 'audio/mp4',
			    'file_type_id' => 3
		    ],
		    [
			    'extension' => 'wav',
			    'mimetype' => 'audio/vnd.wav',
			    'file_type_id' => 3
		    ],
		    [
			    'extension' => 'ogg',
			    'mimetype' => 'audio/ogg',
			    'file_type_id' => 3
		    ],
		    
		    
		    // Documents
		    [
			    'extension' => 'doc',
			    'mimetype' => 'application/msword',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'dot',
			    'mimetype' => 'application/msword',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'docx',
			    'mimetype' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'dotx',
			    'mimetype' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'ppt',
			    'mimetype' => 'application/vnd.ms-powerpoint',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'pps',
			    'mimetype' => 'application/vnd.ms-powerpoint',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'pptx',
			    'mimetype' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'ppsx',
			    'mimetype' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'pdf',
			    'mimetype' => 'aplication/pdf',
			    'file_type_id' => 4
		    ],
		    [
			    'extension' => 'txt',
			    'mimetype' => 'text/plain',
			    'file_type_id' => 4
		    ],
		    
		    
		    //MISC
		    [
			    'extension' => 'zip',
			    'mimetype' => 'application/zip',
			    'file_type_id' => 5
		    ],
		    [
			    'extension' => 'rar',
			    'mimetype' => 'application/x-rar-compressed',
			    'file_type_id' => 5
		    ],
		    
	
	    ];
	    
	    foreach ($tuples as $tuple){
	    	DB::table('au_file_extension')->insert($tuple);
	    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('au_file_extension');
    }
}
