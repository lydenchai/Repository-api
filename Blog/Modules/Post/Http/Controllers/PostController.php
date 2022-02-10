<?php

namespace rsModules\Post\Http\Controlle;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Post;
use Modules\Post\Tansformers\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(5));

        // $post = PostResource::collection(Post::latest()->paginate(5));
        // return view('post.index',compact('post'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);      
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function createNewPost(Request $request)
    {      
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:4096',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $post = new Post();
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $post['image'] = "$postImage";
        }
        Post::create($post);
        return redirect()->route('posts.index')->with('success','Post created successfully.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Post $post )
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit( Post  $id)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatePost(Request $request, Post $id)
    {   
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:4096',
        ]);

        $post = Post::find($id);
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->description = $request->description;
        if ($image = $request->file('image')) {
            $imageDestinationPath = 'uploads/';
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($imageDestinationPath, $postImage);
            $post['image'] = "$postImage";
        }else{
            unset($post['image']);
        }
        $post->update($post);
        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                         ->with('success','Post deleted successfully');
    }
}
