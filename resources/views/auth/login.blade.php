<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

    <h1 class="text-3xl font-bold text-center mb-6">🔐 Login</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black px-4 py-2"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input
                type="password"
                name="password"
                required
                class="w-full rounded-lg border-gray-300 focus:border-black focus:ring-black px-4 py-2"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-black text-white py-2 rounded-lg hover:bg-gray-800 transition font-semibold"
        >
            Login
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-6">
        Don’t have an account?
        <a href="{{ route('register.show') }}" class="text-blue-600 hover:underline">
            Register
        </a>
    </p>

</div>

</body>
</html>
