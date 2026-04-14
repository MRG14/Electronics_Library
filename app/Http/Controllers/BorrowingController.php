<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Menampilkan daftar semua peminjaman (admin: semua, user: milik sendiri)
     */
    public function index() {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $borrowings = Borrowing::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        } else {
            $borrowings = Borrowing::with(['user', 'book'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        return view('panel.borrowings.index', compact('borrowings'));
    }

    /**
     * User mengajukan permintaan peminjaman buku
     */
    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Pastikan buku sudah approved
        if ($book->status !== 'approved') {
            return back()->with('error', 'Buku ini tidak tersedia untuk dipinjam');
        }

        //cek apakah buku sedang dipinjam atau tidak
        $isBeingBorrowed = Borrowing::where('book_id', $book->id)
        ->whereIn('status', ['pending', 'approved'])
        ->exists();

        if ($isBeingBorrowed) {
            return back()->with('error', 'Buku ini Sedang dipinjam. silahka coba lagi nanti');
        }

        //cek apakah user punya peminjaman aktif yang sama
        $alreadyRequested = Borrowing::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->whereIn('status', ['pending', 'approved'])
        ->exists();

        if ($alreadyRequested) {
            return back()->with('error', 'Kamu sudah mengajukan peminjaman pada buku ini');
        }

        //Buat record peminjaman baru
        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan peminjama berhasil dikirim! Silahkan tunggu konfirmasi dari admin');
    }

    /**
     * Tampilkan peminjaman review halaman khusus admin
     */
    public function showApproval(Borrowing $borrowing) {
        $user = auth()->user();

        // Ini hanya admin
        if ($user->role !== 'admin') {
            return redirect()->route('borrowings.index');
        }

        //Hanya yang masih pending
        if ($borrowing->status !== 'pending') {
            return redirect()->route('borrowings.index');
        }

        return view('panel.borrowings.detail', compact('borrowing'));
    }

    /**
     * Admin melakukan approval atau rejection peminjaman
     */
    public function handleApproval(Request $request, Borrowing $borrowing) {
        $user = auth()->user();

        //hanya admin
       if ($user->role !== 'admin') {
            return redirect()->route('borrowings.index');
       }

       $request->validate([
            'approval' => 'required:in:approve,reject',
       ]);

       if ($request->approval === 'approve') {
            $borrowing->status = 'approved';
            $borrowing->borrowed_at = now();    
            $borrowing->due_date = now()->addDays(7); //batas waktu 7 har   i
       } else {
            $borrowing->status = 'rejected';
       }

       $borrowing->save();
       return redirect()->route('borrowings.index')->with('success', 'Review peminjaman berhasil dikirim!');
    }

    public function showReturn(Borrowing $borrowing) {
        $user = auth()->user();

        //hanya admin
        if ($user->role !== 'admin') {
            return redirect()->route('borrowing.index');
        }

        //Hanya sedang approved
        if ($borrowing->status !== 'approved') {
            return redirect()->route('borrowings.index');
        }

        return view('panel.borrowings.return', compact('borrowing'));
    }

    public function handleReturn(Borrowing $borrowing) {
        $user = auth()->user();

        //Hanya admin
        if ($user->role !== 'admin') {
            return redirect()->route('borrowing.index');
        }

        if ($borrowing->status !== 'approved') {
            return redirect()->route('borrowings.index')->with('error', 'Status peminjaman tidak valid.');
        }

        $borrowing->status = 'returned';
        $borrowing->returned_at = now();
        $borrowing->save();

        return redirect()->route('borrowings.index')->with('success', 'Pengembalian buku berhasil dikonfirmasi');
    }
    
    public function requestReturn(Borrowing $borrowing) {
        // pastikan ini milik user yang sudah login
        if ($borrowing->user_id !== auth()->id()) {
            return back()->with('error','aksi tidak diizinkan');
        }

        //hanya bisa jika status masih approved
        if ($borrowing->status !== 'approved') {
            return back()->with('error','Peminjaman ini tidak dalam status aktif');
        }

        $borrowing->return_requested = true;
        $borrowing->save();
 
        return back()->with('success', 'Pengajuan pengembalian berhasil dikirim! Silakan kembalikan buku ke admin.');
    }

    public function handleDelete(Borrowing $borrowing) {
        $borrowing->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
