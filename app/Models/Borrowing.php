<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
        'return_requested',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
        'return_requsted' => 'boolean',
    ];

    /**
     * Relationship
     */

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function book() {
        return $this->belongsTo(Book::class);
    }

    /**
     * Scopes Default
     */
    public function scopePending($query) {
        return $query->where('status', 'pending');
    }

    /**
     * Scopes Approved
     */
    public function scopeApproved($query) {
        return $query->where('status', 'approved');
    }

    /**
     * Scopes Rejected
     */
    public function scopeRejected($query) {
        return $query->where('status', 'rejected');
    }

    /**
     * Scopes Returned
     */
    public function scopeReturned($query) {
        return $query->where('status', 'returned');
    }

    /**
     * Scopes Active
     */
    public function scopeActive($query) {
        return $query->where('status', 'approved');
    }
}
