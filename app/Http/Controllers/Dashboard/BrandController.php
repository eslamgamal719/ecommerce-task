<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $brands = Brand::select(['id', 'name', 'image'])->orderBy('id', 'desc')->paginate(config('constants.paginator'));
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * @param BrandRequest $request
     * @return RedirectResponse
     */
    public function store(BrandRequest $request)
    {
        $data['name'] = $request->name;

        $brand = Brand::create($data);

        activity()->causedBy(auth()->user())->performedOn($brand)->createdAt(now())->log('created');

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('dashboard/brands/' . $file_name);

            Image::make($file->getRealPath())->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $brand->image = $file_name;
            $brand->save();
        }
        if($brand) {
            return redirect()->route('admin.brands.index')->with(['success' => 'Brand created successfully']);
        }
        return redirect()->route('admin.brands.index')->with(['error' => 'Operation not done, there is an error']);
    }

    /**
     * @param Brand $brand
     * @return Application|Factory|View
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * @param BrandRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $data['name'] = $request->name;

        $brand->update($data);

        if($request->hasFile('image')) {
            if(File::exists('dashboard/brands/' . $brand->image)) {
                unlink('dashboard/brands/' . $brand->image);
            }
            $file = $request->file('image');
            $file_name = Str::random(3) . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('dashboard/brands/' . $file_name);

            Image::make($file->getRealPath())->resize(500, null, function($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $brand->image = $file_name;
            $brand->save();
        }

        activity()->causedBy(auth()->user())->performedOn($brand)->createdAt(now())->log('updated');

        if($brand) {
            return redirect()->route('admin.brands.index')->with(['success' => 'Brand updated successfully']);
        }
        return redirect()->route('admin.brands.index')->with(['error' => 'Operation not done, there is an error']);
    }

    /**
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        if(File::exists('dashboard/brands/' . $brand->image)) {
            unlink('dashboard/brands/' . $brand->image);
        }
        if($brand->delete()) {
            activity()->causedBy(auth()->user())->performedOn($brand)->createdAt(now())->log('deleted');
            return redirect()->route('admin.brands.index')->with(['success' => 'Brand deleted successfully']);
        }
        return redirect()->route('admin.brands.index')->with(['error' => 'Operation not done, there is an error']);
    }
}
