<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostModel;

class ImageModel extends Model
{
    public $timestamps = false;
    public $table = 'images';

    public $fillable = [
        'belongs_to_post_id',
        'url',
        'server_path',
    ];

    public function post() {
        return $this->belongsTo(PostModel::class);
    }

    public static function getPostsImages($postID)
    {
        return DB::select(
            "SELECT * FROM images WHERE belongs_to_post_id = (:post_id);",
            [
                'post_id' => $postID
            ]
        );
    }

    public static function deleteByURL($url, $postID)
    {
        DB::delete("DELETE FROM images WHERE url = (:url) AND belongs_to_post_id = (:post_id);", 
        [
            'url' => $url,
            'post_id' => $postID
        ]);
    }
}
