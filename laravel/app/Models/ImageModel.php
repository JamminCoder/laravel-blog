<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Models\PostModel;
use Illuminate\Support\Facades\Storage;

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

    public function delete() {
        Storage::disk('my_files')->delete($this->server_path);
        return parent::delete();
    }
}
