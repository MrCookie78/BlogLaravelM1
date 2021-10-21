<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdatePictureRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $loading = false;

        // $posts = Post::paginate(5);
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(9);
        // $posts = Post::orderBy('created_at', 'DESC')->get();
        return view('posts.posts', compact(['loading', 'posts']));
    }

    public function detail($id = null){
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts.detail', compact(['post', 'categories']));
    }

    public function add(){
        $categories = Category::all();
        return view('posts.formAjout', compact(['categories']));
    }

    public function store(PostStoreRequest $request){

        $params = $request->validated();
        $file = Storage::put('public', $params["picture"]);
        $params['picture'] = substr($file, 7);
        $post = Post::create($params);

        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }

        return redirect()->route('postList');
    }

    public function update($id, PostUpdateRequest $request)
    {
        $params = $request->validated();
        $post = Post::find($id);
        $post->update($params);

        $post->categories()->detach();
        if(!empty($params['checkboxCategories'])){
            $post->categories()->attach($params['checkboxCategories']);
        }

        return redirect()->route('postDetail', $id);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        //Si on trouve l'image, on la supprime
        if (Storage::exists("public/$post->picture")) {
            Storage::delete("public/$post->picture");
        }

        $post->delete();
        return redirect()->route('postList');
    }

    public function updatePicture($id, PostUpdatePictureRequest $request)
    {
        $params = $request->validated();
        $post = Post::find($id);

        if (Storage::exists("public/$post->picture")) {
            Storage::delete("public/$post->picture");
        }
        $file = Storage::put('public', $params["picture"]);
        $params['picture'] = substr($file, 7);
        $post->picture = $params['picture'];
        $post->save();
        return redirect()->route('postDetail', $id);
    }
}


// return view('test')
//     ->with('loading', $loading);
//     ->with('load', $loading)
//     ->with('loading', $loading);
