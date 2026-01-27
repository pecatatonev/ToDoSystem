<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to My Todo List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="text-center">
    <h1 class="text-4xl font-bold mb-6">📝 Welcome to My Todo List!</h1>

    @if(session('api_token'))
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Logout
            </button>
        </form>

        <a href="{{ route('todos.index') }}"
           class="block mt-4 bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800">
            Go to Dashboard
        </a>
    @else
        <a href="{{ route('login.show') }}"
           class="block mb-2 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Login
        </a>

        <a href="{{ route('register.show') }}"
           class="block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            Register
        </a>
    @endif
</div>

</body>
</html>