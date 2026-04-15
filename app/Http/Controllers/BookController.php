<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(){
        $user = auth()->user();

        // Admin can see all books
        if ($user->role === 'admin') {
            $books = Book::with(['user', 'category'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        } else {
            // User sees only their own books
            $books = Book::with(['user', 'category'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('panel.books.index', compact('books'));
    }

    public function showCreateForm(){
        return view('panel.books.form', [
            'book' => null,
            'categories' => Category::all(),
        ]);
    }

    public function showUpdateForm(Book $book){
        $user = auth()->user();

        // Check author
        if ($book->user_id !== $user->id){
            // Redirect to book list
            return redirect()->route('books.index');
        }

        // Check book status
        if ($book->status === 'approved'){
            // Redirect to book list
            return redirect()->route('books.index');
        }    

        return view('panel.books.form', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    public function showApproval(Book $book){
        $user = auth()->user();

        // Check role
        if ($user->role !== 'admin') {
            // Redirect to book list
            return redirect()->route('books.index');
        }

        // Check book status
        if ($book->status !== 'waiting approval'){
            // Redirect to book list
            return redirect()->route('books.index');
        }

        return view('panel.books.detail', [
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    public function handleCreate(Request $request){
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        // Get slug
        $slug = str($request->title)->slug . '-' . str()->random(3);

        // Prepare database model
        $book = new Book();
        $book->title = $request->title;
        $book->slug = $slug;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->user_id = auth()->id();
        $book->status = 'waiting approval';

        // Upload image
        if ($request->hasFile('image')) {
            $book->image_path = $request->file('image')->store('books/images', 'public');
        }

        // Upload pdf
        if ($request->hasFile('file')) {
            $book->file_path = $request->file('file')->store('books/files', 'public');
        }

        // Save to database
        $book->save();

        // Return response
        return redirect()->back()->with('success', 'Karya berhasil dikirim!');
    }

    public function handleUpdate(Request $request, Book $book){
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf|max:10240',
        ]);

        // Regenerate slug if title changed
        if ($request->title !== $book->title) {
            $book->slug = str($request->title)->slug() . '-' . str()->random(3);
        }

        // Prepare database model
        $book->title = $request->title;
        $book->description = $request->description;
        $book->category_id = $request->category_id;
        $book->status = 'waiting approval'; // reset approval

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($book->image_path);
            $book->image_path = $request->file('image')->store('books/images', 'public');
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($book->file_path);
            $book->file_path = $request->file('file')->store('books/files', 'public');
        }

        // Save to database
        $book->save();

        // Return response
        return redirect()->back()->with('success', 'Karya berhasil diperbarui!');
    }

    public function handleDelete(Book $book){
        //Cek apakah buku sedang dipinjam
        $isBorrowed = $book->borrowings()->where('status', '!=', 'returned')->exists();
        if ($isBorrowed) {
            return back()->with('error', 'Buku Sedang Dipinjam dan Tidak bisa Dihapus');
        }

        // Soft delete
        $book->delete();

        // Return response
        return back()->with('success', 'Karya berhasil dihapus!');
    }

    public function handleApproval(Request $request, Book $book){
        // Validate input
        $request->validate([
            'approval' => 'required|in:approve,reject'
        ]);

        // Update book status
        $book->status = $request->approval === 'approve'
            ? 'approved'
            : 'rejected';

        // Update book approved_at
        $book->approved_at = now();

        // Save to database
        $book->save();

        // Return response
        return redirect()->route('books.index')->with('success', 'Approval berhasil dikirim!');
    }
}
