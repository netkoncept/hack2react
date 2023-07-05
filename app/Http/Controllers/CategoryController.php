<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
                         'name' => $request->get('name'),
                         'force_localization' => (int)($request->get('force_localization')=='on'),
                         'citizen' => (int)($request->get('citizen')=='on'),
                         'tourist' => (int)($request->get('tourist')=='on'),
                         'icon'=>'',
                     ]);
        session()->flash('flash.banner', 'Dodano kategorię: ' . $request->get('name'));
        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $attributes = [
            'name' => $request->get('name'),
            'force_localization' => (int)($request->get('force_localization')=='on'),
            'citizen' => (int)($request->get('citizen')=='on'),
            'tourist' => (int)($request->get('tourist')=='on'),
            'icon'=>'',
        ];


        $category->update($attributes);
        session()->flash('flash.banner', 'Zapisano kategorię: ' . $category->name);
        return to_route('categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('flash.banner', 'Usunięto kategorię: ' . $category->name);

        return to_route('categories.index');
    }
}
