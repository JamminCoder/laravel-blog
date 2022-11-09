<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllowNullPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("posts", function (Blueprint $table) {
            $table->string("post_id")->nullable()->change();
            $table->string("is_published")->nullable()->change();
            $table->string("author_id")->nullable()->change();
            $table->string("post_title")->nullable()->change();
            $table->string("post_id")->nullable()->change();
            $table->string("post_description")->nullable()->change();
            $table->text("content")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("posts", function (Blueprint $table) {
            $table->string("post_id")->nullable(false)->change();
            $table->string("is_published")->nullable(false)->change();
            $table->string("author_id")->nullable(false)->change();
            $table->string("post_title")->nullable(false)->change();
            $table->string("post_id")->nullable(false)->change();
            $table->string("post_description")->nullable(false)->change();
            $table->text("content")->nullable(false)->change();
        });
    }
}
