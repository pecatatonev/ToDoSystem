<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    public function index()
    {
        $response = Http::withToken(session('api_token'))
            ->get(config('app.url') . '/api/categories');

        $categories = $response->json();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Http::withToken(session('api_token'))
            ->post(config('app.url') . '/api/categories', [
                'name' => $request->name
            ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully!');
    }
}