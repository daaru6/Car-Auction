<?php

namespace App\Http\Controllers;

use App\Lib\Generic;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarBrands;
use App\Models\CarGallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CarController extends Controller
{
    // CRUD Car Category 
    
    public function add_category(Request $request)
    {
        $data['title'] = "Add Category";
        $data['all_category'] = CarCategory::all();
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'category_name' => 'required|string|unique:car_categories',
            ]);
            $category = CarCategory::create([
                'category_name' => $request->category_name,
                'slug' => Str::slug($request->category_name, '-'),
            ]);
            if (!empty($category)) {
                return redirect()->back()->with('success', "Category Created Succesfully!");
            }
        }
        return view('admin.car.category.create')->with('data', $data);
    }

    public function edit_category(Request $request)
    {
        $id = $request->query('id');
        $data['title'] = "Edit Category";
        $data['all_category'] = CarCategory::all();
        $category = CarCategory::findOrFail($id);
        $data['edit_category'] = $category;
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'category_name' => 'required|unique:car_categories',
            ]);
            $category->category_name = $request->category_name;
            $category->slug = Str::slug($request->category_name, '-');
            $category->save();
            if (!empty($category)) {
                return redirect()->back()->with('success', "Category Updated Succesfully!");
            }
        }
        return view('admin.car.category.edit', ['id' => $id])->with('data', $data);
    }

    public function delete_category(Request $request)
    {
        $id = $request->query('id');
        $category = CarCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('delete', "Category Deleted Succesfully!");
    }
    // Car brands CRUD
    public function add_brand(Request $request)
    {
        $data['title'] = "Add Brand";
        $data['all_brands'] = CarBrands::all();
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'brand_name' => 'required|string|unique:car_brands',
            ]);
            $brand = CarBrands::create([
                'brand_name' => $request->brand_name,
                'slug' => Str::slug($request->brand_name, '-'),
            ]);
            if (!empty($brand)) {
                return redirect()->back()->with('success', "Brand Created Succesfully!");
            }
        }
        return view('admin.car.brand.create')->with('data', $data);
    }

    public function edit_brand(Request $request)
    {
        $id = $request->query('id');
        $data['title'] = "Edit Brand";
        $data['all_brands'] = CarBrands::all();
        $brand = CarBrands::findOrFail($id);
        $data['edit_category'] = $brand;
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'brand_name' => 'required|string|unique:car_brands',
            ]);
            $brand->brand_name = $request->brand_name;
            $brand->slug = Str::slug($request->brand_name, '-');
            $brand->save();
            if (!empty($brand)) {
                return redirect()->back()->with('success', "Brand Updated Succesfully!");
            }
        }
        return view('admin.car.brand.edit', ['id' => $id])->with('data', $data);
    }

    public function delete_brand(Request $request)
    {
        $id = $request->query('id');
        $brand = CarBrands::findOrFail($id);
        $brand->delete();
        return redirect()->back()->with('delete', "Brand Deleted Succesfully!");
    }

    public function add_car(Request $request)
    {
        $data['title'] = "Add Car";
        $data['all_category'] = CarCategory::all();
        $data['all_brands'] = CarBrands::all();
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'car_name' => 'required',
                'car_type' => 'required',
                'price' => 'required',
                'expiry_date' => ['required', function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lessThan(Carbon::today())) {
                        $fail('The expiry date must be a date after or equal to today.');
                    }
                }],
                'category_id' => 'required',
                'brand_id' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg|max:10000',
                'additional_images.*' => 'required|mimes:jpg,png,jpeg|max:10000',
            ]);

            $data = [
                'car_name' => $request->car_name,
                'description' => $request->description,
                'car_type' => $request->car_type,
                'price' => $request->price,
                'expiry_date' => $request->expiry_date,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'user_id' => $request->user()->id,
                'slug' => Str::slug($request->car_name, '-'),
            ];
            if (!empty($request->file('image'))) {
                $data['image'] =  Generic::upload_image($request->file('image'));
            }
            $car = Car::create($data);
            if ($request->file('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $filename =   Generic::upload_image($image);
                    CarGallery::create([
                        'car_id' => $car->car_id,
                        'image' => $filename,
                    ]);
                }
            }
            if (!empty($car)) {
                return redirect()->back()->with('success', "Car Created Succesfully!");
            }
        }
        return view('user.car.create')->with('data', $data);
    }

    public function edit_car(Request $request)
    {
        $id = $request->query('id');
        $data['title'] = "Edit Car";
        $data['all_category'] = CarCategory::all();
        $data['all_brands'] = CarBrands::all();
        $car = Car::with(['gallery', 'category', 'brand'])->findOrFail($id);
        $data['edit'] = $car;
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'car_name' => 'required',
                'car_type' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
                'image.*' => 'required|mimes:jpg,png,jpeg|max:10000',
                'additional_images.*' => 'required|mimes:jpg,png,jpeg|max:10000',
            ]);
            $data = [
                'car_name' => $request->car_name,
                'description' => $request->description,
                'car_type' => $request->car_type,
                'price' => $request->price,
                'expiry_date' => $request->expiry_date,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'user_id' => $request->user()->id,
                'slug' => Str::slug($request->car_name, '-'),
            ];
            if (!empty($request->file('image'))) {
                $data['image'] =  Generic::upload_image($request->file('image'));
            }
            $car->update($data);
            if ($request->file('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $filename = Generic::upload_image($image);
                    CarGallery::create([
                        'car_id' => $car->car_id,
                        'image' => $filename,
                    ]);
                }
            }
            if (!empty($car)) {
                return redirect()->back()->with('success', "Car Updated Succesfully!");
            }
        }
        return view('user.car.edit')->with('data', $data);
    }

    public function user_cars(Request $request)
    {
        $data['title'] = "All Your Cars";
        $id = $request->user()->id;
        $data['user_cars'] = Car::with(['category', 'brand'])->where('user_id', $id)->get();
        return view('user.car.all')->with('data', $data);
    }

    public function delete_car(Request $request)
    {
        $id = $request->query('id');
        Car::findOrFail($id)->delete();
        return redirect()->back()->with('delete', "Car Deleted Succesfully!");
    }

    public function delete_car_gallery_image(Request $request)
    {
        $id = $request->query('id');
        CarGallery::findOrFail($id)->delete();
        return redirect()->back()->with('success', "Image Deleted Succesfully!");
    }
}
