<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // foreach ($posts as $post) {
        //     echo ($post->user_id);
        // }
        // $posts = Post::where('id', '=', 1)->select('id', 'title', 'content')->get();
        // echo "<pre>";print_r($posts[0]->title);exit();
        $f = Post::destroy([30]);
        var_dump($f);exit();
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $name="张晓宾";
        // $users = DB::select('select * from `users` where `name` = :name', ['name' => $name]);
        // $email = DB::table('users')->where('name',$name)->value('email');
        // $users = DB::table('users')->where('id', '<', 10)->pluck('email', 'name');
        $names = [];
        DB::table('users')->orderBy('id')->chunk(5, function ($users) use (&$names) {
            foreach ($users as $user) {
                $names[] = $user->name;
            }
        });
        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('posts.*', 'users.name', 'users.email')
            ->get();
        echo "<pre>";print_r($posts[0]->name);exit();
        // return 'Post ' . $id . ' Link: ' . route('post.show', [$id]);
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
}
