<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Defines the schema for the 'comments' table
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            /**
             * Foreign key referencing the 'posts' table
             * Ensures the foreign key constraint with 'posts' table
             * Deletes the comment if the related post is deleted
             */
            $table->foreignId('post_id') -> constrained()->onDelete('cascade');
            /**
             * Foreign key referencing the 'users' table
             * Ensures the foreign key constraint with 'users' table
             * Deletes the comment if the related user is deleted
             */
            $table->foreignId('user_id') -> constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
