<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\User;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /*
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', [
            'posts' => $posts,
        ]);
        */
        public function index()
    {
       // $posts = Post::all();
       // return view('posts.index', [
            //'posts' => DB::table('posts')->paginate(15)
       // ]);
       $posts = Post::paginate(15);
       return view('posts.index', [
        'posts' => $posts,
    ]);
    }

    
    public function show($post)
    {
        $post = Post::find($post);
       

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create',[
            'users' => User::all()
        ]);
    }

    public function store(StorePostRequest $myRequestObject)
    {
        $data = $myRequestObject->all();
        Post::create($data);
        $post = new Post();
       // $post->title = $myRequestObject->title;
        $post->slug = SlugService::createSlug(Post::class, 'slug', $myRequestObject->title);
        return redirect()->route('posts.index');
    }
    public  function edit(Post $post){
        $users = User::all();
        return view('posts.edit' ,['post' => $post, 'users' => $users]);
     
    } 
    public  function update(StorePostRequest $request,$post){

    $spost=Post::findOrFail($post);
    $spost->update([
        'title' => $request['title'],
        'description' =>$request['description'],
        'user_id' =>$request['user_id'],
    ]);
    return redirect()->route('posts.index');
    }
    public function run()
{
    User::factory()
            ->count(50)
            ->create();
}

    public  function destroy($post){
       
       // $post=Post::find($id);
        //$post->delete();
        //return redirect()->back()->with('statues','Post Delete');
        Post::destroy($post);
        return redirect()->route('posts.index');


    }
}
