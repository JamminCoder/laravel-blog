<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
        DB::delete('DELETE FROM posts WHERE post_id = (:post_id);', ['post_id' => $postID]);
    }

    public static function loadPostPreviews()
    {
        return DB::select('SELECT * FROM posts ORDER BY created_at DESC');
    }

    public static function idIsUnique($id)
    {
        $matchedIDs = DB::table('posts')->where('post_id', $id)->first();
        
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
            ["is_published" => true]
        );
    }
}
