<?php

use App\Enums\orders\OrdersItemsStatusEnum;
use App\Enums\orders\OrdersPaymentTypeEnum;
use App\Enums\orders\OrdersStatusEnum;
use App\Models\items\ItemsCategoriesModel;
use App\Models\items\ItemsModel;
use App\Models\orders\OrdersItemsModel;
use App\Models\orders\OrdersModel;
use App\Models\tables\TablesPlacesModel;
use App\Models\users\CustomerModel;
use App\Models\users\UserModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new OrdersItemsModel())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->references('id')->on((new OrdersModel())->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('item_id')->nullable()->references('id')->on((new ItemsModel())->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->string('status')->default(OrdersItemsStatusEnum::Preparing->name);
            $table->decimal('amount', 10, 2);
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('final_price', 10, 2);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new OrdersItemsModel())->getTable());
    }
};
