<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Post;

// not forget this
use Illuminate\Http\Request;

class PostController extends Controller
{

    use ApiResponseTrait;
    // get all post from database
    public function index(){
        $Posts = PostResource::collection(Post::paginate($this->paginate));
        //using function ResponseTrait from file ApiResponseTrait
        return $this->ResponseTrait($Posts);
    }

    // show only call single post
    public function show($id){
        $Post = Post::find($id);
        //checked by function show about find id post or not found
        return $Post ?  $this->ResponseTrait(new PostResource($Post)) : $this->not_found();
    }

    //delete posts
    public function delete($id){
        $Post = Post::find($id);
        //checked by function show about find id post or not found
         if ($Post){
             $Post->delete();
             return  $this->delete_Response();
        }
        return $this->not_found();
    }



    // create post
    public function store(Request $request){

        // validator title and body
        $valid = $this->Validatorse($request);
        if ($valid instanceof Response) {
            return $valid;
        }


        // created post
        $post =  Post::create($request->all());

        return $post ? $this->creating_Response($post)  :
            $this->ResponseTrait(null ,'some error!!',520);
    }



//    function update post
    public function update(Request $request,$id){


        // validator title and body
        $valid = $this->Validatorse($request);
        if ($valid instanceof Response) {
            return $valid;
        }

        // find id
        $Post = Post::find($id);
        //checked by function show about find id post or not found
       if(!$Post){
           return  $this->not_found();
       }


        // created post
        $Post->update($request->all());
        return $Post ?  $this->creating_Response($Post) :
            $this->Some_error();
    }

    //Validator title and body
    public  function Validatorse($request){
        //this function in file ApiResponseTrait
        return $this->Validators($request , [
            'title' => 'required|unique:posts|max:255|min:4',
            'body' => 'required|min:4',
        ]);
    }


}
