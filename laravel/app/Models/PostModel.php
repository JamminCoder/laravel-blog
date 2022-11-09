<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\ImageModel;

class PostModel extends Model
{
    public $table = 'posts';
    // public $timestamps = false;

    protected $fillable = [
        'post_id',
        'header_image_url',
        'post_title',
        'post_description',
        'content',
        'author_id'
    ];

    public function images() {
        return $this->hasMany(ImageModel::class);
    }

    public static function getPostByID($postID)
    {
        return self::firstWhere('post_id', $postID);
    }

    public static function updatePost($newContent, $newTitle, $newDescription, $postID)
    {
        $post = self::firstWhere("post_id", $postID);

        $post->content = $newContent;
        $post->post_title = $newTitle;
        $post->post_description = $newDescription;
        $post->post_id = $postID;

        $post->update();
    }

    public static function loadPostPreviews()
    {
        $posts = DB::table("posts")
                ->where("is_published", true)
                ->orderBy("created_at", "desc")->get();

        return $posts;
    }

    public static function idIsUnique($id)
    {
        $matchedIDs = self::firstWhere('post_id', $id);
        
        // ID is not unique
        if ($matchedIDs) return false;
        
        // The ID is unique.
        return true;
    }

    public static function generateSlug($title) {
        $exploded = explode(" ", $title);
        $slug = "";
        foreach ($exploded as $piece) {
            if ($piece === "") return;

            $slug .= strtolower($piece) . "_";
        }
        
        $time = Carbon::now()->toDateString();
        $slug .= $time;

        return $slug;
    }

    public static function getAuthorsUnpublishedPost($author_id) {
        return self::firstWhere(
            ["author_id" => $author_id],
            ["is_published" => false]
        );
    }

    public function delete() {
        $images = $this->images()->get();
        
        foreach ($images as $image) {
            $image->delete();
        }

        return parent::delete();
    }
}
