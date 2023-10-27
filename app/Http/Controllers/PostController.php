<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct post list page
    public function index(){
        $category = Category::get();
        $post = Post::get();


        $userInfo = User::get();
        $userDetails = Auth::user()->id;

        // dd($userDetails);
        // dd($userInfo->toArray());
        return view('admin.post.index',compact('category','post','userInfo','userDetails'));
    }

    //create post
    public function createPost(Request $request){
        $validation = $this->postValidationCheck($request);
        if($validation->fails()){
            return back()
                        ->withErrors($validation)
                        ->withInput();
        }
        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getPostData($request,$fileName);
        }else{
            $data = $this->getPostData($request,null);
        }
        // dd($request->toArray());
        // $file = $request->file('postImage');
        // $fileName = uniqid().'_'.$file->getClientOriginalName();
        // $file->move(public_path().'/postImage',$fileName);
        // $data = $this->getPostData($request,$fileName);
        // dd($data);

        Post::create($data);


        // return view('admin.post.index',compact('userInfo'));
        return back();
        // dd($fileName);
    }

    //delete post
    public function deletePost($post_id){
        $postData = Post::where('post_id',$post_id)->first();
        $dbImageName = $postData['image'];
        Post::where('post_id',$post_id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back();
    }

    //update post
    public function updatePostPage($id){
        // dd(Auth::user()->id);

        $category = Category::get();
        $postDetails = Post::where('post_id',$id)->first();
        $post = Post::get();
        $userInfo = User::get();
        // dd($userInfo);
        $userDetails = Auth::user()->id;
        // dd($postDetails->toArray());
        return view('admin.post.update',compact('category','postDetails','post','userInfo','userDetails'));
    }

    //postUpdate
    public function postUpdate($id,Request $request){
        $validation = $this->postValidationCheck($request);
        if($validation->fails()){
            return back()
                        ->withErrors($validation)
                        ->withInput();
        }
        $data = $this->postUpdateData($request);
        if(isset($request->postImage)){
            $this->storeNewUpdate($id,$request,$data);
        }else{
            Post::where('post_id',$id)->update($data);

        }
        return back();
        // dd($data);
    }

    //getPostData
    private function getPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postDescriptionName,
            'id' => $request->userName,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ];
    }

    // store new update
    private function storeNewUpdate($id,$request,$data){
        // get image name
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();

        // store image name
        $data['image'] = $fileName;

        //replace the image name
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];

        // if have old image delete,new image added
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }

        // file updated
        $file->move(public_path().'/postImage',$fileName);

        // id's data updated
        Post::where('post_id',$id)->update($data);
    }

    // get post update data
    private function postUpdateData($request){
        return [
            'title'=> $request->postTitle,
            'description' => $request->postDescription,
            'image' => $request->postImage,
            'category_id' => $request->postDescriptionName,
            'id' => $request->userName,
            'created_at' => Carbon::now(),

        ];
    }

    //post validation check
    private function postValidationCheck($request){
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postDescriptionName' => 'required'
        ],[
            'postTitle.required' => 'No Post Title Found',
            'postDescription.required' => 'No Post Description Found',
            'postDescriptionName.required' => 'Choose Post Description Name',
        ]);
    }
}
