<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);
        return view('admin.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id' , 0) ->get();
        return view('admin.categories.create' , compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories,slug',
            'parent_id'=>'required',
        ]);

        Category::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'is_active'=>$request->is_active,
            'parent_id'=>$request->parent_id,
            'icon'=>$request->icon,
        ]);

        alert()->success('با تشکر','دسته بندی با موفقیت اضافه شد');
        return redirect()->route('admin.categories.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::where('parent_id' , 0) ->get();
        return view('admin.categories.edit' , compact('category' , 'parentCategories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories,slug,'.$category->id,
            'parent_id'=>'required',
        ]);
        $category->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'is_active'=>$request->is_active,
            'parent_id'=>$request->parent_id,
            'icon'=>$request->icon,
        ]);

        alert()->success('با تشکر','دسته بندی با موفقیت ویرایش شد');

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
