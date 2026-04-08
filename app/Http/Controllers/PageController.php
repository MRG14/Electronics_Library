<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $books = Book::with(['user', 'category'])
            ->where('status', 'approved')
            ->orderBy('total_views', 'desc')
            ->limit(8)
            ->get();

        return view('index', compact('books'));
    }

    public function showCategories(){
        $categories = Category::orderBy('title', 'asc')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function showBooks(Request $request){
        // Get books
        $books = Book::with(['user', 'category'])
            ->where('status', 'approved')

            // Filter by keyword
            ->when($request->keyword, function ($query, $keyword) {
                $query->where(function($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
                });
            })

            // Filter by category
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })

            ->orderBy('approved_at', 'desc')
            ->paginate(8)
            ->withQueryString();

        // Get categories
        $categories = Category::orderBy('title')->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function showBookDetails(Book $book)
    {
        // Only show approved book
        if ($book->status !== 'approved') {
            abort(404);
        }

        $sessionKey = "viewed_book_{$book->id}";

        // Count view only once every 30 minutes
        if (!session()->has($sessionKey)) {
            $book->increment('total_views');

            // store timestamp to throttle refresh
            session([$sessionKey => now()]);
        } else {
            // re-allow after 30 minutes
            $lastViewed = session($sessionKey);
            if (now()->diffInMinutes($lastViewed) >= 30) {
                $book->increment('total_views');
                session([$sessionKey => now()]);
            }
        }

        return view('books.details', compact('book'));
    }
}
