<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
// use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $post = Post::with('author')->with('categories')->with('tags')->get();

        // $data = [
        //     'post' => $post
        // ];

        // return view('dashboard.post.index', $data);

        if (isset($request->search)) {
            $post = Post::search('title', $request->search)->search('subtitle', $request->search)->search('content', $request->search)->paginate(20);

            $post->appends(['search' => $request->search]);
        } else {
            $post = Post::paginate(20);
        }

        $data = [
            'post' => $post
        ];

        return view('dashboard.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        $data = [
            'category' => $category,
        ];

        return view('dashboard.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        // dd($request);

        // $request->validate([
        //     'english_title' => 'required',
        //     'indonesia_title' => 'required',

        //     'english_subtitle' => 'required',
        //     'indonesia_subtitle' => 'required',

        //     'english_content' => 'required',
        //     'indonesia_content' => 'required',

        //     'english_meta_description' => 'required',
        //     'indonesia_meta_description' => 'required',

        //     'cover' => 'required|image',
        //     'slug' => 'required',
        //     'category' => 'required'
        // ]);

        $post = new Post();

        switch ($request->action) {
            case 'draft':
                $post->is_published = false;
                break;
            case 'publish':
                $post->is_published = true;
                break;
        }

        $name = Str::slug($request->input('english_title'));
        $extension = $request->file('cover')->extension();
        $request->file('cover')->storeAs('public/cover', $name . '.' . $extension, 'local');

        $cover = 'storage/cover/' . $name . '.' . $extension;

        $post->cover = $cover;

        $post->author_id = Auth::user()->id;

        $post->title = [
            'en' => $request->input('english_title'),
            'id' => $request->input('indonesia_title')
        ];
        $post->subtitle = [
            'en' => $request->input('english_subtitle'),
            'id' => $request->input('indonesia_subtitle')
        ];
        $post->content = [
            'en' => $request->input('english_content'),
            'id' => $request->input('indonesia_content')
        ];
        $post->meta_desc = [
            'en' => $request->input('english_meta_description'),
            'id' => $request->input('indonesia_meta_description')
        ];

        $post->slug = Str::slug($request->input('slug'));

        $post->save();

        $categories = explode(',', $request->input('category'));

        $post->categories()->sync($categories);

        $tags = explode(',', $request->input('tag'));

        foreach ($tags as $row) {
            Tag::firstOrCreate(['name' => $row, 'slug' => Str::slug($row)])->save();
        }

        $tags = Tag::whereIn('name', $tags)->get()->pluck('id');
        $post->tags()->sync($tags);

        return redirect()->route('dashboard.post.index')->with('flash.banner', 'Successfully created a new post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();

        $data = [
            'post' => $post,
            'category' => $category
        ];

        return view('dashboard.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        switch ($request->action) {
            case 'draft':
                $post->is_published = false;
                break;
            case 'publish':
                $post->is_published = true;
                break;
        }

        if ($request->has('cover')) {
            if (file_exists(public_path($post->cover))) {
                unlink(public_path($post->cover));
            }

            $name = Str::slug($request->input('english_title'));
            $extension = $request->file('cover')->extension();
            $request->file('cover')->storeAs('public/cover', $name . '.' . $extension, 'local');

            $cover = 'storage/cover/' . $name . '.' . $extension;
            $post->cover = $cover;
        }

        $post->title = [
            'en' => $request->input('english_title'),
            'id' => $request->input('indonesia_title')
        ];
        $post->subtitle = [
            'en' => $request->input('english_subtitle'),
            'id' => $request->input('indonesia_subtitle')
        ];
        $post->content = [
            'en' => $request->input('english_content'),
            'id' => $request->input('indonesia_content')
        ];
        $post->meta_desc = [
            'en' => $request->input('english_meta_description'),
            'id' => $request->input('indonesia_meta_description')
        ];

        $post->slug = $request->input('slug');

        $post->save();

        $categories = explode(',', $request->input('category'));

        $post->categories()->sync($categories);

        $tags = explode(',', $request->input('tag'));

        // Create all tags (unassociet)
        foreach ($tags as $row) {
            Tag::firstOrCreate(['name' => $row, 'slug' => Str::slug($row)])->save();
        }

        // Once all tags are created we can query them
        $tags = Tag::whereIn('name', $tags)->get()->pluck('id');
        $post->tags()->sync($tags);

        return redirect()->route('dashboard.post.index')->with('flash.banner', 'Successfully updated a post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (file_exists(public_path($post->cover))) {
            unlink(public_path($post->cover));
        }

        $post->delete();

        return redirect()->back()->with('flash.banner', 'Successfully deleted a post!');
    }


    // /**
    //  * Handle Categories for Post
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param \App\Post $post
    //  * @return void
    //  */
    // public function handleCategories(Request $request, Post $post)
    // {
    //     /**
    //      * Once the post has been saved, we deal with the tag logic.
    //      * Grab the tag or tags from the field, sync them with the article
    //      */
    //     $categories = explode(',', $request->category);

    //     $post->categories()->sync($categories);
    // }

    // /**
    //  * Handle Tags for Post
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param \App\Post $post
    //  * @return void
    //  */
    // public function handleTags(Request $request, Post $post)
    // {
    //     /**
    //      * Once the post has been saved, we deal with the tag logic.
    //      * Grab the tag or tags from the field, sync them with the article
    //      */
    //     $tags = explode(',', $request->tag);

    //     // Create all tags (unassociet)
    //     foreach ($tags as $row) {
    //         Tag::firstOrCreate(['name' => $row, 'slug' => Str::slug($row)])->save();
    //     }

    //     // Once all tags are created we can query them
    //     $tags = Tag::whereIn('name', $tags)->get()->pluck('id')->get();
    //     $post->tags()->sync($tags);
    // }
}
