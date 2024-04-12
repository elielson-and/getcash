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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 11, 2)->default(0);
            $table->foreignId('user_id')->constrained();
            $table->integer('installment_amount')->default(1);
            $table->integer('current_installment')->default(1);
            $table->decimal('installment_value', 11, 2)->default(0)->nullable();
            $table->date('payment_date')->nullable();
            $table->unsignedBigInteger('loan_status_id');
            $table->foreign('loan_status_id')->references('id')->on('loan_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
