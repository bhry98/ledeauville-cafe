<?php

use App\Enums\orders\OrdersPaymentTypeEnum;
use App\Enums\orders\OrdersStatusEnum;
use App\Models\items\ItemsCategoriesModel;
use App\Models\items\ItemsModel;
use App\Models\orders\OrdersModel;
use App\Models\tables\TablesModel;
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
        Schema::create((new OrdersModel())->getTable(), function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->foreignId('table_id')->nullable()->references('id')->on((new TablesModel())->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('cacher_id')->nullable()->references('id')->on((new UserModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->references('id')->on((new CustomerModel)->getTable())->cascadeOnUpdate()->nullOnDelete();
            $table->string('status')->default(OrdersStatusEnum::Open->name);
            $table->string('payment_type');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new OrdersModel())->getTable());
    }
};
