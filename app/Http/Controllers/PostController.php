<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $loading = false;

        // $posts = Post::paginate(5);
        $posts = Post::orderBy('updated_at', 'DESC')->get();
        // $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('posts.posts', compact(['loading', 'posts']));
    }

    public function detail($id = null){
        if($id){
            $post = Post::find($id);
            return view('posts.detail', compact(['post']));
        }
    }

    public function add(){
        return view('posts.formAjout');
    }

    public function store(PostStoreRequest $request){

        $params = $request->validated();
        Post::create($params);

        return redirect()->route('postList');
    }

    public function update($id, PostStoreRequest $request)
    {
        $params = $request->validated();
        $post = Post::find($id);
        $post->update($params);

        return redirect()->route('postDetail', $id);
    }

    public function delete($id)
    {
        $posts = Post::find($id);
        $posts->delete();
        return redirect()->route('postList');
    }
}


// return view('test')
//     ->with('loading', $loading);
//     ->with('load', $loading)
//     ->with('loading', $loading);
