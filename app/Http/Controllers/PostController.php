<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts'=> $posts]);
    }

    /**
     * @throws ValidationException
     */
    public function postCreatePost(Request $request): RedirectResponse
    {
        $this->validate($request,['body'=>'required|max:1000']);

        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if($request->user()->posts()->save($post)){
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDeletePost($post_id): RedirectResponse
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Post successfully deleted']);
    }

    public function getEditPost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        return view('editpost', compact('post'));
    }

    public function update(Request $request ,$post_id)
    {
        $this->validate($request,['body'=>'required|max:1000']);
        $post = Post::where('id', $post_id)->first();

        $body = $request->input('body');
        $post->body = $body;
        $post->save();

        return redirect()->route('dashboard');
    }

}
