<x-layouts.app :title="('Create New Product Category')">
    <flux:heading>Create New Product Category</flux:heading>
    <flux:subheading>Form untuk menambah product category baru</flux:subheading>
    <flux:separator variant="subtle" />

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <flux:input name="name" label="Name" placeholder="Product Category Name" value="{{ old('name') }}" required />
        <flux:input name="slug" label="Slug" placeholder="Product Category Slug" value="{{ old('slug') }}" required />
        <flux:input name="sku" label="SKU" placeholder="Product Category SKU" value="{{ old('sku') }}" required />

        <div>
            <label for="product_category_id" class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
            <select name="product_category_id" id="product_category_id" class="w-full border border-gray-300 rounded p-2">
                <option value="">Select Parent Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <flux:input name="price" label="Price" type="number" placeholder="Product Category Price" value="{{ old('price') }}" required />
        <flux:input name="stock" label="Stock" type="number" placeholder="Product Category Stock" value="{{ old('stock') }}" required />

        <flux:textarea name="description" label="Description" placeholder="Product Category Description" required>
            {{ old('description') }}
        </flux:textarea>

        <flux:input name="image" type="file" label="Image" placeholder="Product Category Image" />

        <flux:select label="Status" name="is_active" class="mb-2" required>
            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonactive</option>
        </flux:select>

        <flux:button type="submit" icon="plus" variant="primary" class="mt-4">Simpan</flux:button>
    </form>
</x-layouts.app>
