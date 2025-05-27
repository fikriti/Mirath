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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['text', 'image', 'video', 'pdf', 'link','audio']);
            $table->text('value'); // هيبقى نص أو رابط حسب النوع
            $table->text('note')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('user_add_id')->nullable();
            $table->string('file')->nullable(); //  هنا أضفناه
            $table->timestamps();
        });
        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
            $table->foreign('user_add_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
