<x-layouts.app :title="('Edit Product Category')">
    <flux:heading>Edit Product Category</flux:heading>
    <flux:subheading>Form untuk mengubah data product category</flux:subheading>
    <flux:separator variant="subtle"/>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <flux:input name="name" label="Name" value="{{ old('name', $category->name) }}" placeholder="Product Category Name" required/>
        <flux:input name="slug" label="Slug" value="{{ old('slug', $category->slug) }}" placeholder="Product Category Slug" required/>
        <flux:input name="sku" label="SKU" value="{{ old('sku', $category->sku) }}" placeholder="Product Category SKU" required/>

        <div>
            <label for="product_category_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
            <select name="product_category_id" id="product_category_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">Select Parent Category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('product_category_id', $category->product_category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <flux:input name="price" label="Price" type="number" value="{{ old('price', $category->price) }}" placeholder="Product Category Price" required/>
        <flux:input name="stock" label="Stock" type="number" value="{{ old('stock', $category->stock) }}" placeholder="Product Category Stock" required/>

        <flux:select label="Status" name="is_active" class="mb-2" required>
            <option value="1" {{ old('is_active', $category->is_active) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active', $category->is_active) == 0 ? 'selected' : '' }}>Nonactive</option>
        </flux:select>

        <flux:textarea name="description" label="Description" placeholder="Product Category Description" required>
            {{ old('description', $category->description) }}
        </flux:textarea>

        @if($category->image)
            <div class="mb-3">
                <img src="{{ Storage::url($category->image) }}" 
                alt="{{ $category->name }}" 
                class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        <flux:input name="image" type="file" label="Image" placeholder="Product Image" />
        <flux:button type="submit" icon="plus" variant="primary" class="mt-4 mb-4">Simpan</flux:button>
    </form>
</x-layouts.app>
