<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('description', 'like', '%' . $request->q . '%');
            })
            ->paginate(10);

        return view('dashboard.categories.index', [
            'categories' => $categories,
            'q' => $request->q,
            'title' => 'Manajemen Kategori Produk',
        ]);
    }

    public function create()
    {
        return view('dashboard.categories.create', [
            'title' => 'Tambah Kategori Produk',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|max:1000',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('errorMessage', 'Validasi Error, Silakan lengkapi data terlebih dahulu');
        }

        $category = new Categories;
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('dashboard.categories.index')
            ->with('successMessage', 'Data Berhasil Disimpan');
    }

    public function show(string $id)
    {
        $category = Categories::findOrFail($id);

        return view('dashboard.categories.show', [
            'category' => $category,
            'title' => 'Detail Kategori Produk',
        ]);
    }

    public function edit(string $id)
    {
        $category = Categories::findOrFail($id);

        return view('dashboard.categories.edit', [
            'category' => $category,
            'title' => 'Edit Kategori Produk',
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()
                ->with('errorMessage', 'Validasi Error, Silakan lengkapi data terlebih dahulu');
        }

        $category = Categories::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('uploads/categories', $imageName, 'public');
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->route('dashboard.categories.index')
            ->with('successMessage', 'Data Berhasil Diperbarui');
    }

    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('successMessage', 'Data Berhasil Dihapus');
    }
}
