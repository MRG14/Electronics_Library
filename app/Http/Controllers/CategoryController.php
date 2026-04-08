<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $user = auth()->user();

        // Check role
        if ($user->role !== 'admin') {
            // Redirect to book list
            return redirect()->route('books.index');
        }

        $categories = Category::orderBy('title', 'asc')
            ->paginate(10);

        return view('panel.categories.index', compact('categories'));
    }

    public function showCreateForm(){
        $user = auth()->user();

        // Check role
        if ($user->role !== 'admin') {
            // Redirect to book list
            return redirect()->route('books.index');
        }

        return view('panel.categories.form', [
            'category' => null
        ]);
    }

    public function showUpdateForm(Category $category){
        $user = auth()->user();

        // Check role
        if ($user->role !== 'admin') {
            // Redirect to book list
            return redirect()->route('books.index');
        }
        
        return view('panel.categories.form', [
            'category' => $category
        ]);
    }

    public function handleCreate(Request $request){
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048'
        ]);

        // Prepare database model
        $category = new Category();
        $category->title = $request->title;

        // Upload image
        if ($request->hasFile('image')) {
            $category->image_path = $request->file('image')->store('categories/images', 'public');
        }

        // Save to database
        $category->save();

        // Return response
        return redirect()->back()->with('success', 'Kategori berhasil dikirim!');
    }

    public function handleUpdate(Request $request, Category $category){
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $category->title = $request->title;

        if ($request->hasFile('image')) {
            if ($category->image_path){
                Storage::disk('public')->delete($category->image_path);
            }
            $category->image_path = $request->file('image')->store('categories/images', 'public');
        }

        // Save to database
        $category->save();

        // Return response
        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function handleDelete(Category $category){
        // Soft delete
        $category->delete();

        // Return response
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
