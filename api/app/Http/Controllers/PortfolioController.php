<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;


class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $portfolios = Portfolio::all();
        return response()->json(
            $portfolios
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
            'title' => "required|max:255|unique:Portfolios|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'meta_title' => "required|unique:Portfolios|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'description' => "required|max:1023|regex:/^[a-zA-Z0-9 .,():!?'-]+$/",
            'slug'=> "required|max:255|unique:Portfolios|regex:/^[a-zA-Z0-9 -]+$/",
            'content' => "required|regex:/^[a-zA-Z0-9 .,()\[\]:*!<>?'-]+$/",
            'github' => "required|regex:/^[a-zA-Z0-9 .,()\[\]:*!<>?'-]+$/",
            'link' => "required|regex:/^[a-zA-Z0-9 .,()\[\]:*!<>?'-]+$/",
            'image' => "required|regex:/^[a-zA-Z0-9 .,()\[\]:*!<>?'-]+$/",

        ]); 
        $Portfolio = new Portfolio(); 
        $Portfolio->title = $request->title; 
        $Portfolio->meta_title = $request->meta_title; 
        $Portfolio->content = $request->content; 
        $Portfolio->slug = $request->slug; 
        $Portfolio->description = $request->description; 
        $Portfolio->github = $request->github; 
        $Portfolio->link = $request->link; 
        $Portfolio->image = $request->image; 

        $Portfolio->save(); 

        return response()->json(
            ['message'=>'Successful','data' => $Portfolio]
            , 201); 


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
        $portfolio = Portfolio::where('slug','=',$slug)->first();
        return response()->json(
            $portfolio
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
        $portfolios = Portfolio::latest()->take(4)->get();
        return response()->json(
            $portfolios
            , 201); 

    }
}
