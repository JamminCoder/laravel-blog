<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\PostModel;

class UpdateImagesAndPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean("is_published")->nullable()->default(true);
        });


        Schema::table('images', function (Blueprint $table) {
            $table->foreignIdFor(PostModel::class);
            $table->dropColumn("belongs_to_post_id");
            $table->id();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("images", function (Blueprint $table) {
            $table->string("url");
            $table->dropColumn("id");
            $table->foreignIdFor(null);
        });
    }
}
