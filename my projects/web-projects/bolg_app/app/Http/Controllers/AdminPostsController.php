<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(2);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();;
        return view('admin.posts.create', compact('categories'));
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
            'title'=> 'required',
            'category_id'=> 'required',
            'photo_id'=> 'required',
            'body'=> 'required'
        ]);

        $user = Auth::user();

        $input = $request->all();

        if($request->hasFile( 'photo_id')){
            $file = $request->photo_id;
            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=> $name]);

            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::findOrFail($slug);
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required'
        ]);
        $input = $request->all();

        if($request->hasFile('photo_id')){
            $file = $request->photo_id;
            $file->move('images', $file->getClientOriginalName());

            $photo = Photo::create(['file'=>$file->getClientOriginalName()]);
            $input['photo_id'] = $photo->id;
        }

        $user = auth()->user();
        $user->posts()->where('id', $id)->first()->update($input);
        return redirect('admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(file_exists(public_path().$post->photo->file)){
            unlink(public_path().$post->photo->file);
        }
        $post->delete();
        return redirect('admin/posts');
    }

    public function post($slug){

        $post = Post::where('slug', $slug)->first();
        return view('post', compact('post'));
    }
}
