<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $categories = Category::paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $validated = $request->all();
        $validated['slug'] = Str::slug($validated['title']);

        $category = Category::create($validated);

        if (!$category) abort(500);

        return redirect()->route('categories.index')->with('success', 'Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->all();
        $validated['slug'] = Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Updated successfully');
    }

    public function destroy()
    {
        if (request()->has('id')){
            $id = request()->id;
            $category = Category::findOrFail($id);

            $category->shops()->detach();

            $category->delete();

            return response()->json([
                'response' => [
                    'code'    => 200,
                    'message' => 'Deleted successfully',
                ]
            ]);
        }else{
            abort(500);
        }
    }
}
