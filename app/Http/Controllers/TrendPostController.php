<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    public function index(){
        $categoryList = Category::select('category_id','title','description')->get();
        $post = Post::select('posts.*','users.*',DB::raw('COUNT(posts.category_id) as post_count'))
                ->leftJoin('users','users.id','posts.category_id')
                ->groupBy('posts.category_id')
                ->get();
        // dd($post->toArray());s
        return view('admin.trend.index',compact('post','categoryList'));
    }

    // trendPostDetails
    public function details($id){
        // $post = Post::get();
        $post = Post::select('posts.*','users.*')
        ->leftJoin('users','users.id','posts.id')
        ->groupBy('users.id','posts.id')
        ->where('category_id',$id)
        ->get();

        // $post1 = Post::where('category_id',$id)->get();
        // dd($post->toArray());
        return view('admin.trend.details',compact('post'));
    }

    public function accept_post($id){
        dd($id);
        $data  = Post::find($id);
        dd($data);
        $data->post_status ='active';

        $data->save();

        return back();
    }
}

