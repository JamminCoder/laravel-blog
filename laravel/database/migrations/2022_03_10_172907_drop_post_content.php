<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPostContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('post_content');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('post_content', function (Blueprint $table) {
            $table->integer('content_index');
            $table->string('belonds_to_author_id');
            $table->string('belonds_to_post_id');
            $table->string('content');
            $table->boolean('is_image');
        });
    }
}
