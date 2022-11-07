<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $shops = Shop::with('categories');

        if (request()->has('categories')){
            $filter = request()->categories;
            $shops->whereHas('categories', function($query) use($filter){
                $query->whereIn('category_id',$filter);
            });
        }

        $categories = Category::all();

        $shops = $shops->paginate(5);

        return view('shops.index', compact('shops', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::all();

        return view('shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ShopRequest $request
     * @return RedirectResponse
     */
    public function store(ShopRequest $request): RedirectResponse
    {
        $validated = $request->all();
        $validated['slug'] = Str::slug($validated['name']);

        $shop = Shop::create($validated);

        $shop->categories()->attach($validated['categories']);

        return redirect()->route('shops.index')->with('success', 'Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $categories = Category::all();
        $shop = Shop::with('categories')->findOrFail($id);
        $shop_categories = [];

        foreach ($shop->categories as $category) {
            $shop_categories[] = $category->id;
        }

        return view('shops.edit', compact('categories', 'shop', 'shop_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ShopRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ShopRequest $request, int $id): RedirectResponse
    {
        $shop = Shop::findOrFail($id);

        $validated = $request->all();
        $validated['slug'] = Str::slug($validated['name']);

        $shop->update($validated);

        $shop->categories()->sync($validated['categories']);

        return redirect()->route('shops.index')->with('success', 'Updated successfully');
    }

    public function destroy()
    {
        if (request()->has('id')){
            $id = request()->id;
            $shop = Shop::findOrFail($id);

            $shop->categories()->detach();

            $shop->delete();

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
