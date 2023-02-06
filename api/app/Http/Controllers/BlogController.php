<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Resources\BlogCollection;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs = Blog::all();
        return response()->json(
            $blogs
            , 201); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => "required|max:255|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'meta_title' => "required|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'description' => "required|max:1023|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'slug'=> "required",
            'content' => "required|regex:/^[a-zA-Z0-9 .,()\[\]:*!<>?'-]+$/",
        ]); 
        $blog = new Blog(); 
        $blog->title = $request->title; 
        $blog->meta_title = $request->meta_title; 
        $blog->content = $request->content; 
        $blog->slug = $request->slug; 
        $blog->description = $request->description; 

        $blog->save(); 

        return response()->json(
            ['message'=>'Successful','data' => $blog]); 


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //Blog
        $blog = Blog::where('slug','=',$slug)->first();
        return response()->json(
            $blog
            , 201); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
        $blog=Blog::find($id);
        

        //$blog->title=$request->title;
        //$blog->slug=$request->slug;



        $input = $request->all();

        $blog->update($input);

        return $blog;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function latest(){
        $blogs = Blog::latest()->take(5)->get();
        return response()->json(
            $blogs
            , 201); 

    }
}
