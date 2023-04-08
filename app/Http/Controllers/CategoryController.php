<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Str;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('category.index');
    }
    public function categoryformSubmit(Request $request)  
    {  
        $category = new Category([
            'cat_name' => $request->input('cat_name'),
            'cat_sulg' => Str::slug($request->input('cat_name')),
            'cat_des' => $request->input('cat_des')
        ]);
        $category->save();
        $success = "Category created Successfully";
        // $category = Category::all();
        return response()->json($success);
    } 
    public function showcategory(){
        return view('category.showcategory');
    }
    public function returncategory(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function category_delete($id){
        $category = Category::find($id);
        $category->delete();
    }
}
