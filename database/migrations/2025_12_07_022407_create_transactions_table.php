// database/migrations/2024_01_01_000004_create_transactions_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 15, 2);
            $table->enum('payment_method', ['virtual_account', 'qris']);
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['waiting_approval', 'paid', 'cancelled'])->default('waiting_approval');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};