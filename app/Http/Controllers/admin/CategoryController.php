<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories =  Category::all(); 
        return view('admin.category', compact('categories'));
    }

    public function addcategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|string|max:255',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            return redirect()->route('admin.addcategory')->with('success','added new category successfully');

        } else {
            return redirect()->route('admin.addcategory')
            ->withInput()
            ->withErrors($validator);
        }
    
    }

    
    public function updatecategory(Request $request){
        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
    ]);

    if ($validator->passes()) {
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.addcategory')->with('success', 'Category updated successfully!');
    } else {
        return redirect()->back()->withErrors($validator)->withInput();
    }
   
}

    public function deletecategory(string $id){
        $card = Category::find($id);
        $card->delete();
        return redirect()->route('admin.addcategory')->with('success', 'Category deleted successfully!');
    }
}
