<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(5);
        //dd($categories);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::pluck('title', 'id')->all();            //получаем массив категорий с title и id
        $tags = Tag::pluck('title', 'id')->all();                       //получаем массив тегов с title и id

       return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'title' =>'required|max:128',
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required|integer',
            'thumbnail'=>'nullable|image'
        ];
        $customMessages =[
            'title.required'=>'Поле Название не может быть пустым!',
            'description.required' => 'Поле Цитата не может быть пустым!',
            'content.required'=>'Поле Контент не может быть пустым!',
        ];
        $this->validate($request, $rules,$customMessages);

        //dd($request->all());
        $data = $request->all();

        $data['thumbnail'] = Post::uploadImage($request);

        $post = Post::create($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('success', 'Статья добавлена');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);
        $categories = Category::pluck('title', 'id')->all();            //получаем массив категорий с title и id
        $tags = Tag::pluck('title', 'id')->all();                       //получаем массив тегов с title и id

        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
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
        $rules = [
            'title' =>'required|max:128',
            'description'=>'required',
            'content'=>'required',
            'category_id'=>'required|integer',
            'thumbnail'=>'nullable|image'
        ];
        $customMessages =[
            'title.required'=>'Поле Название не может быть пустым!',
            'description.required' => 'Поле Цитата не может быть пустым!',
            'content.required'=>'Поле Контент не может быть пустым!',
        ];
        $this->validate($request, $rules,$customMessages);

        $post = Post::find($id);
       // dd($request->all());

        $data = $request->all();

        if ($file = Post::uploadImage($request, $post->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        $post->update($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index')->with('success', 'Изменения сохранены');

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
        $post->tags()->sync([]);
        Storage::delete($post->thumbnail);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Статья удалена');

    }
}
