<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'description',
        'image_path',
        'file_path',
        'status',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /**
     * Relationships
     */

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function borrowings() {
        return $this->hasMany(Borrowing::class);
    }

    public function activeBorrowings() {
        return $this->hasOne(Borrowing::class)->whereIn('status', ['pending', 'approved']);
    }

    /**
     * Scope for approved books
     */
    public function scopeApproved($query) {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending books
     */
    public function scopePending($query) {
        return $query->where('status', 'waiting approval');
    }

    /**
     * Scope for rejected books
     */
    public function scopeRejected($query) {
        return $query->where('status', 'rejected');
    }

    public function isBeingBorrowed() {
        return $this->borrowings()->where('status', ['pending', 'approved'])->exists();
    }
}
