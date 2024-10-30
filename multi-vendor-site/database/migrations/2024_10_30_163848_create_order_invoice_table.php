<?php

use App\Models\User;
use App\Models\Vendor;
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
        Schema::create('order_invoice', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Vendor::class);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_invoice');
    }
};
