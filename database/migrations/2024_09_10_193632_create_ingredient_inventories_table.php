<?php

use App\Models\IngredientInventory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_inventories', function (Blueprint $table) {
            $table->id();
            $table->integer('ingredient_id'); 
            $table->string('type')->default(IngredientInventory::TYPE_USAGE);
            $table->integer('quantity')->default(1); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_inventories');
    }
}
