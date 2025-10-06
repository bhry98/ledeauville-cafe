<?php

use App\Models\tables\TablesModel;
use App\Models\tables\TablesPlacesModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new TablesModel())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->integer('table_number');
            $table->foreignId('table_place_id')->nullable()->references('id')->on((new TablesPlacesModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new TablesModel())->getTable());
    }
};
