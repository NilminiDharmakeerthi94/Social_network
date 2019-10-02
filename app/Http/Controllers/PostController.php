<?php
namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
//use App\Http\Controllers\Response;

class PostController extends Controller{

    public function getDashboad(){
        $posts= Post::all();
        return view('dashboad', ['posts'=>$posts]);
    }

    public function postCreate(Request $request){
       // return redirect()->route('dashboad');
        
        $this->validate($request,[
        'body'=>'required|max:1000'                   //validation
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
      if( $request->user()->posts()->save($post)){
          $message = 'Post successfully created!';
      }
        return redirect()->route('dashboad')->with(['message'=> $message]);
       

    }
}