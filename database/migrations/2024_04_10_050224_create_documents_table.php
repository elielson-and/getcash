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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11)->unique();
            $table->string('fullName');
            $table->char('gender');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('client_selfie_img')->nullable();
            $table->string('client_rg_img')->nullable();
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('statuses');
            $table->string('revocation_reason')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
