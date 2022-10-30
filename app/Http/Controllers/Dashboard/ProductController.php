<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $selected_columns = ['id', 'image', 'title', 'sku', 'price', 'stock', 'brand_id'];
        $products = Product::select($selected_columns)->orderBy('id', 'desc')->paginate(config('constants.paginator'));

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $brands = Brand::select(['id', 'name'])->get();
        return view('dashboard.products.create', compact('brands'));
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $data['title']      = $request->title;
        $data['brand_id']   = $request->brand_id;
        $data['details']    = $request->details;
        $data['price']      = $request->price;
        $data['stock']      = $request->stock ?? 0;
        $data['sku']        = strtoupper($request->sku);

        $product = Product::create($data);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('dashboard/products/' . $file_name);

            Image::make($file->getRealPath())->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $product->image = $file_name;
            $product->save();
        }

        activity()->causedBy(auth()->user())->performedOn($product)->createdAt(now())->log('created');

        if($product) {
            return redirect()->route('admin.products.index')->with(['success' => 'Product created successfully']);
        }
        return redirect()->route('admin.products.index')->with(['error' => 'Operation not done, there is an error']);
    }

    /**
     * @param Product $product
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $data['brands']  = Brand::select(['id', 'name'])->get();
        $data['product'] = $product;
        return view('dashboard.products.edit', $data);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data['title']      = $request->title;
        $data['brand_id']   = $request->brand_id;
        $data['details']    = $request->details;
        $data['price']      = $request->price;
        $data['stock']      = $request->stock ?? 0;
        $data['sku']        = strtoupper($request->sku);

        $product->update($data);

        if($request->hasFile('image')) {
            if(File::exists('dashboard/products/' . $product->image)) {
                unlink('dashboard/products/' . $product->image);
            }
            $file = $request->file('image');
            $file_name = Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('dashboard/products/' . $file_name);

            Image::make($file->getRealPath())->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $product->image = $file_name;
            $product->save();
        }

        activity()->causedBy(auth()->user())->performedOn($product)->createdAt(now())->log('updated');

        if($product) {
            return redirect()->route('admin.products.index')->with(['success' => 'Product updated successfully']);
        }
        return redirect()->route('admin.products.index')->with(['error' => 'Operation not done, there is an error']);
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        if(File::exists('dashboard/products/' . $product->image)) {
            unlink('dashboard/products/' . $product->image);
        }
        if($product->delete()) {
            activity()->causedBy(auth()->user())->performedOn($product)->createdAt(now())->log('deleted');
            return redirect()->route('admin.products.index')->with(['success' => 'Product deleted successfully']);
        }
        return redirect()->route('admin.products.index')->with(['error' => 'Operation not done, there is an error']);
    }
}
