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
        return DB::table('posts')->where('post_id', $postID)->first();
    }

    public static function updatePost($newContent, $newTitle, $newDescription, $postID)
    {
        // Deletes post_content from the database
        DB::update(
            "UPDATE posts
            SET 
            content = (:new_content),
            post_title = (:new_title),
            post_description = (:new_description)
            WHERE post_id = (:post_id);",

            [
                'new_content' => $newContent,
                'new_title' => $newTitle,
                'new_description' => $newDescription,
                'post_id' => $postID,
            ]
        );
    }

    public static function deletePostByID($postID)
    {
        self::firstWhere("post_id", $postID)->delete();
    }

    public static function loadPostPreviews()
    {
        $posts = DB::table("posts")->orderBy("created_at", "desc")->get();
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
