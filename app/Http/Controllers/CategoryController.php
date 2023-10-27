<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        // $category = Category::get();
        $categoryList = Category::select('category_id','title','description')->get();
        // dd($category);
        return view('admin.category.index',compact('categoryList'));
    }

    //category create
    public function createCategory(Request $request){
        $validator = $this->categoryValidationCheck($request);

        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        // dd($categoryData);
        $data = $this->getCategoryData($request);
        $dbCategory = Category::create($data);
        // dd($dbCategory->toArray());
        return back()->with(['createSuccess' => "Thanks For Creating Disease Category"]);
    }

    //category list search
    public function categorySearchList(Request $request){
        $categoryList = Category::orWhere('title','LIKE','%'.$request->nameSearchKey.'%')
                    ->orWhere('description','LIKE','%'.$request->nameSearchKey.'%')
                    ->get();
        return view('admin.category.index',compact('categoryList'));
    }

    //category edit page
    public function categoryEditPage($id){
        $categoryList = Category::select('category_id','title','description')->get();
        $updateData = Category::where('category_id',$id)->first();
        // dd($updateData->toArray());
        return view('admin.category.edit',compact('updateData','categoryList'));
    }

    //category update
    public function categoryUpdate($id,Request $request){
        $validator = $this->categoryValidationCheck($request);
        // dd($id);
        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData = $this->categoryUpdateValidationCheck($request);
        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category')->with(['updateSuccess' => "Updated Successfully"]);
    }

    // direct delete account
    public function deleteCategory($category_id){
        Category::where('category_id',$category_id)->delete();
        return redirect()->route('admin#category')->with(['deleteSuccess' => "Category Deleted"]);
    }

    //categoryValidationCheck
    private function categoryValidationCheck($request){
        return Validator::make($request->all(), [
            'categoryTitle' => 'required',
            'categoryDescription' => 'required'
            ]);
    }


    //categoryUpdateValidationCheck
    private function categoryUpdateValidationCheck($request){
        return[
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now()
        ];
    }

    //categoryData
    private function getCategoryData($request){
        return [
            'id'=> $request->id,
            'title' => $request->categoryTitle,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
