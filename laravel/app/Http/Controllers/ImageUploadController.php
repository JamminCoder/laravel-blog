<?php

namespace App\Http\Controllers;

use App\Models\ImageModel;
use App\Models\PostModel;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ImageUploadController extends Controller
{
    public function upload()
    {
        // Get the parameter string
        $parameterString = file_get_contents('php://input');
        $parameterArray = array();

        // Seperate the different parameters since the 
        // parameterString looks like param_name=value&other_param_name=value&more_params=etc...
        $paramGroups = explode('&', $parameterString);
        foreach($paramGroups as $paramGroup)
        {
            // $paramGroup looks like: param1=value

            // Get the parameter name and value
            $paramName = explode('=', $paramGroup)[0];
            $paramValue = explode('=', $paramGroup)[1];

            // Add the parameter to $parameterArray so we can extract the param value:
            // $extractedValue = $parameterArray['param_name']
            $parameterArray[$paramName] = $paramValue;

        }
        
        // Extract the image from the parameter array
        $image = base64_decode($parameterArray['image']);

        $path = 'images/resource/' . date('mdy') . '-' . uniqid();
        $imageUrl = URL::to($path);

        $post = PostModel::firstWhere("post_id", $parameterArray['post_id']);

        $imageModel = new ImageModel([
            'url' => $imageUrl,
            'server_path' => $path,
        ]);

        
        // Save the image
        Storage::disk('my_files')->put($path, $image);
        
        $post->images()->save($imageModel);

        return response('Image Uploaded Successfuly!', 200, array('url' => $imageUrl));
    
    }

    public static function deleteUnusedImage(Request $request)
    {
        $content = $request->content;
        
        // gets the markdown image URL
        preg_match_all('!\[[^\]]*\]\((.*?)\s*("(?:.*[^"])")?\s*\)!', $content, $matches, PREG_PATTERN_ORDER);
        $imageUrls = $matches[1];

        // Get the images that this post stores in the database (does not get remote images)
        $postImages = PostModel::firstWhere("post_id", $request->post_id)->images()->get();

        // Delete unused images from this post in the database and file system
        foreach($postImages as $image)
        {
            if (!in_array($image->url, $imageUrls))
            {
                $image->delete();
            }
        }
    }

}
