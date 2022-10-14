<?php

namespace App\Http\Controllers;

use App\Models\Category;
//use App\Http\Requests\StoreCategoryRequest;
//use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth',])->except(['index','show']);
        $this->middleware(['admin'])->except(['index','show','unfollow','follow']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $categories =  Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        session()->flash('status', __('Category created!'));
        return redirect()->route('categories.show', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);
        $category->name = $request->name;
        $category->save();

        session()->flash('status', __('Category updated !'));

        return redirect()->route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();

        session()->flash('status', __('Category deleted !'));

        return redirect()->route('categories.index');
    }
    public function follow(Request $request, Category $category)
    {
        $category->followers()->attach($request->user()->id);
        return redirect()->route('categories.show', $category);
    }

    public function unfollow(Request $request, Category $category)
    {
        $category->followers()->detach($request->user()->id);
        return redirect()->route('categories.show', $category);
    }
}
