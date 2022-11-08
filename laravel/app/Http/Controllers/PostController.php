<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function create()
    {
        $post = PostModel::getAuthorsUnpublishedPost(Auth::user()->author_id);
        if (!$post) {
            $post = new PostModel();
            $post->post_id = self::generatePostID();
            $post->save();
        }
        
        return view("create-post", ["post" => $post]);
    }

    public function display(Request $request, $postID)
    {
        $post = PostModel::getPostByID($postID);
        return view('post', ['post' => $post]);
    }

    public function index()
    {
        $postPreviews = PostModel::loadPostPreviews();
        return view('welcome', ['posts' => $postPreviews]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_title' => ['string', 'required'],
            'post_description' => ['string', 'required'],
            'post_content' => ['string', 'required'],
            'post_id' => ['string', 'required']
        ]);

        $post = PostModel::firstWhere("post_id", $request->post_id);

        $post->post_id = PostModel::generateSlug($request->post_title);
        $post->post_title = $request->post_title;
        $post->post_description = $request->post_description;
        $post->content = $request->post_content;
        $post->author_id = Auth::user()->user_id;

        if ($request->hasFile('header_image')) {
            $request->validate([
                'header_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
            ]);

            $path = $request->file('header_image')->store(
                'images/resource', 
                ['disk' => 'my_files']
            );

            $post->header_image_url = $path;
        }
        
        $post->is_published = true;

        $post->save();

        return redirect("/post/$post->post_id");
    }

    public function edit(Request $request, $postID)
    {
        $post = PostModel::getPostByID($postID);
        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Request $request)
    {
        $request->validate([
                'content' => ['string', 'required'],
                'post_title',
                'post_description',
                'post_id' => ['string', 'max:255', 'required']
        ]);

        $postID = $request->post_id;
        $content = $request->content;
        $title = $request->post_title;
        $description = $request->post_description;

        ImageUploadController::deleteUnusedImage($request);

        PostModel::updatePost($content, $title, $description, $postID);

        return redirect("/post/$postID");
    }

    public function delete($postID)
    {
        PostModel::deletePostByID($postID);
        return redirect('/');
    }

    private function generatePostID($length = 32)
    {
        $id = Str::random($length);

        if (PostModel::idIsUnique($id)) return $id;
        
        // ID was not unique, generate it again.
        $this->generatePostID();
    }
}
