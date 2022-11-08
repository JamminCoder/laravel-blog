<?php

use App\Models\PostModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelateImagesAndPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("images", function (Blueprint $table) {
            $table->foreignIdFor(PostModel::class);
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
            $table->foreignIdFor(null);
        });
    }
}
