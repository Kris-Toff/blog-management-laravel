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
        $user = Auth::user();
        $blog_post = BlogPost::where('user_id', $user->id)->get()->toArray();

        return response()->json(['blog_posts' => $blog_post], 200);
    }

    public function getPublishedPosts()
    {
        $blog_post = BlogPost::where('status', 'Publish')->get()->toArray();

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
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Successfully created post'], 201);
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

        return response()->json(['message' => 'Successfully updated post'], 200);
    }

    public function destroy(BlogPost $blog_post)
    {
        $blog_post->delete();

        return response()->json(['message' => 'Successfully deleted post'], 200);
    }

    public function updateStatus(BlogPost $blog_post, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $blog_post->status = $request->status;
        $blog_post->save();

        return response()->json(['message' => 'Successfully updated status'], 200);
    }
}
