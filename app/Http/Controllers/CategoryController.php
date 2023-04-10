<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
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
    public function subcategoryformSubmit(Request $request)  
    {  
        $subcategory = new Subcategory([
            'cat_id' => $request->input('cat_id'),
            'sub_cat_name' => $request->input('sub_cat_name'),
            'sub_cat_slug' => Str::slug($request->input('sub_cat_name')),
            'sub_cat_des' => $request->input('sub_cat_des'),
        ]);
        $subcategory->save();
        $success = "Sub Category created Successfully";
        // $category = Category::all();
        return response()->json($success);
    } 
    public function showcategory(){
        return view('category.showcategory');
    }
    public function showsubcategory(){
        return view('category.showsubcategory');
    }
    public function returncategory(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function returnsubcategory(){
        $categories = \DB::table('subcategories')->select('categories.cat_name','categories.id','subcategories.id','subcategories.sub_cat_name','subcategories.sub_cat_slug', 'subcategories.sub_cat_des', 'subcategories.updated_at', 'subcategories.created_at')->leftJoin('categories', 'subcategories.cat_id', '=', 'categories.id')->get();
        return response()->json($categories);
    }
    public function category_delete($id){
        $category = Category::find($id);
        $category->delete();
    }
    public function sub_category_delete($id){
        $category = Subcategory::find($id);
        $category->delete();
    }
    public function category_edit($id){
        $category = Category::find($id);
        return response()->json($category);
    }
    public function sub_category_edit($id){
        $sub_cat = \DB::table('subcategories')->select('categories.id as cat_id','categories.cat_name','categories.id','subcategories.id','subcategories.sub_cat_name','subcategories.sub_cat_slug', 'subcategories.sub_cat_des', 'subcategories.updated_at', 'subcategories.created_at')->leftJoin('categories', 'subcategories.cat_id', '=', 'categories.id')->where('subcategories.id',$id)->get();
        $cat_list = Category::get();
        $category = ['sub_cat' => $sub_cat, 'cat_list' => $cat_list]; 
        return response()->json($category);
    }
    public function category_update(Request $request){
        Category::where('id', $request->id)->update(['cat_name' => $request->cat_name, 'cat_des' => $request->cat_des]);
        $edit_output = 'Category Update Successfully';
        return response()->json($edit_output);
    }
    public function sub_category_update(Request $request){
        Subcategory::where('id', $request->id)->update(['sub_cat_name' => $request->sub_cat_name, 'sub_cat_des' => $request->sub_cat_des, 'cat_id' => $request->cat_id]);
        $edit_output = 'Sub Category Update Successfully';
        return response()->json($edit_output);
    }
    public function sub_cat_index(){
        return view('category.subcategoryindex');
    }
}
