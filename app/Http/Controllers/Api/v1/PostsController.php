<?php

namespace App\Http\Controllers\Api\v1;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class PostsController extends Controller
{
    public function index()
    {
        $cats = [];
        $posts = Post::paginate(10, ['*'], 'page', request('page'));
        if (\request()->has('cats')) {
            $cats = explode(",",request('cats'));
            $posts = Post::whereIn('category_id', $cats)->paginate(10, ['*'], 'page', request('page'));
        }
        return response()->json([$posts,$cats]);
    }

    public function show($post_id)
    {
        $post = Post::with('images')->find($post_id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description,
            'expected_price' => 2000,
        ]);

        foreach ($request->images as $image) {
            $year = Carbon::now()->year;
            $imagePath = "/upload/images/";
            $imageName = str_random(6) . '.jpg';
            $image = $image['data']; // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $img = Image::make($image);

            $img->save(public_path() . $imagePath . $imageName, 60);

            $post->images()->create([
                'image' => $imagePath . $imageName
            ]);
        }


        return array(
            'status' => 'success',
        );
    }
}
