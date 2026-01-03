<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function add() {
        
        return view('admin.category.add');
    }

    public function store(Request $request) {
        
        $request->validate([
            'category' => 'required'
        ]);

        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return redirect()->back()->with('category_message', 'Category Added Successfully!');
    }

    public function view() {
        $categories = Category::all();
        return view('admin.category.view', compact('categories'));
    }

    public function delete($id) {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('deletecategory_message', 'Category deleted successfully!');
    }

    public function update($id) {
        $category = Category::findOrFail($id);
        return view('admin.category.update', compact('category'));
    }

    public function postUpdate(Request $request, $id) {

           $request->validate([
            'category' => 'required'
        ]);
        
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->back()->with('update_message', 'Category updated successfully!');
    }
}
