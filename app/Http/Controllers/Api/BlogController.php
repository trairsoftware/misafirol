<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return response()->json([
            'status' => true,
            'data' => $blogs,
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required|string|min:3',
           'content' => 'required|string',
           'imageable_name' => 'required',
           'imageable_code' => 'required',
        ]);

        $attributes = $request->only([
            'title',
            'content',
            'imageable_name',
            'imageable_code'
        ]);

        $blog = Blog::create($attributes);

        return response()->json([
            'status'  => true,
            'message' => 'Created Successfully',
            'data'  => $blog
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'title' => 'required|string|min:3',
           'content' => 'required|string',
           'imageable_name' => 'required',
           'imageable_code' => 'required',
        ]);

        $attributes = $request->only([
            'title',
            'content',
            'imageable_name',
            'imageable_code'
        ]);

        $blog = Blog::find($id);

        if($blog){
            $blog->update($attributes);

            return response()->json([
                'status'  => true,
                'message' => 'Updated Successfully',
                'data' => $blog
            ], 200);
        }

        else{
            return response()->json([
                'status'  => false,
                'message' => "Not found!",
                'data' => $blog
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if($blog){
            $blog->delete();

            return response()->json([
                'status'  => true,
                'message' => "Deleted successfully!",
                'data' => $blog
            ]);
        }

        else{
            return response()->json([
                'status'  => false,
                'message' => "Not found!",
                'data' => $blog
            ]);
        }
    }
}
