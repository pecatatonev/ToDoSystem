<!-- resources/views/categories/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">📂 Create Category</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium mb-1">Category Name</label>
            <input 
                type="text" 
                name="name" 
                id="name"
                value="{{ old('name') }}" 
                placeholder="Enter category name"
                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                required
            >
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('todos.index') }}" class="px-4 py-2 rounded-lg border hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-800">
                Create Category
            </button>
        </div>
    </form>
</div>

</body>
</html>
