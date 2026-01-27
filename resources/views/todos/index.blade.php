<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Todos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">📝 My Todos</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
    <div class="flex gap-2">
        <a href="{{ route('todos.create') }}"
           class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800">
            ➕ Add Todo
        </a>

        <a href="{{ route('categories.index') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            📂 View Categories
        </a>
    </div>

    <a href="{{ route('home') }}"
       class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
        🏠 Dashboard
    </a>
</div>

    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="text-xl font-semibold mb-4">Your Todos</h2>

        @if(empty($todos))
            <p class="text-gray-500">No todos yet. Create one above 👆</p>
        @else
            <div class="space-y-3">
                @foreach($todos as $todo)
                    <div class="border rounded-xl p-4 flex items-start justify-between gap-4">

                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-semibold {{ $todo['is_completed'] ? 'line-through text-gray-400' : '' }}">
                                    {{ $todo['title'] }}
                                </h3>

                                <span class="text-xs px-2 py-1 rounded bg-gray-100">
                                    {{ ucfirst($todo['priority']) }}
                                </span>

                                <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-800">
                                    {{ $todo['category']['name'] ?? 'No category' }}
                                </span>
                            </div>

                            @if(!empty($todo['description']))
                                <p class="text-gray-600 mt-2 {{ $todo['is_completed'] ? 'line-through text-gray-400' : '' }}">
                                    {{ $todo['description'] }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2 items-end">

                            {{-- Toggle --}}
                            <form method="POST"
                                  action="{{ route('todos.toggle', $todo['id']) }}">
                                @csrf
                                @method('PUT')

                                <button
                                    class="text-sm px-3 py-1 rounded-lg border hover:bg-gray-50">
                                    {{ $todo['is_completed'] ? '↩ Undo' : '✅ Done' }}
                                </button>
                            </form>

                            {{-- Delete --}}
                            <form method="POST"
                                  action="{{ route('todos.destroy', $todo['id']) }}"
                                  onsubmit="return confirm('Delete this todo?')">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="text-sm px-3 py-1 rounded-lg border border-red-300 text-red-600 hover:bg-red-50">
                                    🗑 Delete
                                </button>
                            </form>

                            <a href="{{ route('todos.edit', $todo['id']) }}"
                            class="text-sm px-3 py-1 rounded-lg border border-blue-300 text-blue-600 hover:bg-blue-50">
                            Edit
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

</body>
</html>