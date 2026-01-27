<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Todo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">✏️ Edit Todo</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-5">
        <form action="{{ route('todos.update', $todo['id']) }}" method="POST" class="grid gap-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input name="title" required
                       value="{{ old('title', $todo['title']) }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Description</label>
                <textarea name="description"
                          class="w-full border rounded-lg px-3 py-2">{{ old('description', $todo['description']) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Category</label>
                    <select name="category_id" required
                            class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Select --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}"
                                @selected(old('category_id', $todo['category_id']) == $category['id'])>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Priority</label>
                    <select name="priority" required
                            class="w-full border rounded-lg px-3 py-2">
                        @foreach(['low','medium','high'] as $priority)
                            <option value="{{ $priority }}"
                                @selected(old('priority', $todo['priority']) == $priority)>
                                {{ ucfirst($priority) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 w-fit">
                💾 Update Todo
            </button>
        </form>
    </div>
</div>

</body>
</html>