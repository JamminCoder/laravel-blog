<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Http\Controllers\ImageUploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Markdown;

class PostController extends Controller
{
    public function create()
    {
        return view("create-post");
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
        ]);

        $post = new PostModel([
            'post_id' => $this->generatePostID(),
            'post_title' => $request->post_title,
            'post_description' => $request->post_description,
            'content' => "# {$request->post_title}\n#### {$request->post_description}",
            'author_id' => Auth::user()->user_id
        ]);

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
        
        $post->is_published = 0;

        $post->save();

        return redirect("/edit-post/$post->post_id");
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
