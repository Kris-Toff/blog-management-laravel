<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $blog_post = BlogPost::get()->toArray();

        return response()->json(['blog_posts' => $blog_post], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::user();

        BlogPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'created_by' => $user->name,
        ]);

        return response()->json(['message' => 'Created'], 201);
    }

    public function update(BlogPost $blog_post, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $blog_post->update($request->all());

        return response()->json(['message' => 'Successfully updated item'], 200);
    }
}
