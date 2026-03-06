<?php

use App\Enums\DotationEpiEnum;
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
        Schema::create('execute_dotation_epis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')->constrained()->onDelete('restrict');
            $table->foreignId('month_dotation_epi_id')->constrained()->onDelete('restrict');
            $table->enum('dotationEPI', DotationEpiEnum::values())->default(DotationEpiEnum::NONE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('execute_dotation_epis');
    }
};
