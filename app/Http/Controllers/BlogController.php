<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\{BlogStoreRequest, BlogUpdateRequest, BlogDestroyRequest};
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request)
    {
        $request->validated();
        $blog = Blog::create(array_merge(
            $request->only('title', 'description', 'content', 'is_published'),
            ['user_id' => $request->user()->id]
        ));
        return response()->json($blog, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $request->validated();
        $blog->update($request->only('title', 'description', 'content', 'is_published'));
        return response()->json($blog, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully'], 204);
    }
}
