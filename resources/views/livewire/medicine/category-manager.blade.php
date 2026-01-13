<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Category Management</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form -->
        <div class="bg-zinc-700 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Add New Category</h3>

            <form wire:submit="save">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Category Name</label>
                    <input
                        type="text"
                        wire:model="name"
                        class="w-full border border-zinc-500 rounded px-3 py-2"
                        placeholder="Enter category name"
                    >
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea
                        wire:model="description"
                        class="w-full border border-zinc-500 rounded px-3 py-2"
                        rows="3"
                        placeholder="Enter description"
                    ></textarea>
                    @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            wire:model="is_active"
                            class="mr-2"
                        >
                        <span class="text-sm">Active</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Save Category
                </button>
            </form>
        </div>

        <!-- List -->
        <div class="bg-zinc-700 p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Categories</h3>

            <div class="space-y-2">
                @forelse($categories as $category)
                    <div class="p-3 border border-zinc-500 rounded flex justify-between items-center">
                        <div>
                            <div class="font-medium">{{ $category->name }}</div>
                            <div class="text-sm text-zinc-400">{{ $category->description }}</div>
                        </div>
                        <div>
                            <span class="px-2 py-1 text-xs rounded {{ $category->is_active ? 'bg-green-100 text-green-500' : 'bg-gray-100 text-zinc-500' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-zinc-300">No categories yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
