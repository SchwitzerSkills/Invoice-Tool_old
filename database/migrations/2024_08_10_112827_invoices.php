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
        Schema::create("invoices", function (Blueprint $table) {
            $table->integer("id")->primary();
            $table->string("company");
            $table->string("invoiceName");
            $table->string("customerName");
            $table->date("invoiceDate");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("invoices");
    }
};
