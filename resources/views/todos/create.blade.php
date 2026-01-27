<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">📝 Create Todo</h1>
        <a href="{{ route('todos.index') }}"
           class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
           ← Back
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-5">
        <form action="{{ route('todos.store') }}" method="POST" class="grid gap-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input name="title" required
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description"
                          class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="category_id" required
                            class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Select --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Priority</label>
                    <select name="priority" required
                            class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>
            </div>

            <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 w-fit">
                ➕ Add Todo
            </button>
        </form>
    </div>
</div>

</body>
</html>