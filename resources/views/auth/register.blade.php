<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - My Todos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-center mb-6">📝 Register</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block mb-1 font-medium text-gray-700">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                required 
                value="{{ old('name') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                required 
                value="{{ old('email') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="password" class="block mb-1 font-medium text-gray-700">Password</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label for="password_confirmation" class="block mb-1 font-medium text-gray-700">Confirm Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
        >
            Register
        </button>
    </form>

    <p class="text-center mt-4 text-gray-600">
        Already have an account? 
        <a href="{{ route('login.show') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>

</body>
</html>
