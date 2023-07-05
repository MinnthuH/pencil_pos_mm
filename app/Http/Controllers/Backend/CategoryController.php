<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // All Category Method
    public function AllCategory(){

        $allCategory = Category::latest()->get();
        return view('backend.category.all_category',compact('allCategory'));
    } // End Method

    // store Category Method
    public function StoreCategory(Request $request){

        Category::insert([
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#category')->with($noti);
    } //End Method

    // Edit Category Method
    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category',compact('category'));
    }// End Method

    // Update Category Method
    public function UpdateCategory(Request $request){
        $categoryId = $request->id;

        Category::findOrFail($categoryId)->update([
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now(),
        ]);
        $noti = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#category')->with($noti);

    } // End Method

    // Delete Category Method
    public function DeleteCategory($id){

        Category::findOrFail($id)->delete();
        $noti = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('all#category')->with($noti);
    }
}
