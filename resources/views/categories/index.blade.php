<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">📂 Categories</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 w-fit inline-block mb-4">
        ➕ Create Category
    </a>

    <a href="{{ route('todos.index') }}"
        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 w-fit">
        📝 Back to Todos
    </a>

    @if(empty($categories) || count($categories) === 0)
        <p class="text-gray-500">No categories yet. Create one above 👆</p>
    @else
        <div class="bg-white rounded-xl shadow p-5">
            <ul class="divide-y divide-gray-200">
                @foreach($categories as $category)
                    <li class="py-2 flex justify-between items-center">
                        <span class="text-gray-800">{{ $category['name'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

</body>
</html>