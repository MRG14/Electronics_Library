<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //foreign key to users->(id)
            $table->unsignedBigInteger('book_id'); //foregin key to books->(id)

            $table->timestamp('borrowed_at')->nullable(); //tangga pinjam
            $table->timestamp('due_date')->nullable(); //batas waktu pengembalian
            $table->timestamp('returned_at')->nullable(); //tanggal dikembalikan

            $table->enum('status', ['pending', 'approved', 'rejected', 'returned'])->default('pending');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
