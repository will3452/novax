<?php

use App\Models\Activity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')
                ->onDelete('set null')
                ->nullable();
            $table->string('name');
            $table->string('type')->default(Activity::TYPE_SYNCHRONOUS);
            $table->string('category')->default(Activity::CATEGORY_QUIZ);
            $table->timestamp('deadline')->nullable();
            $table->timestamp('time_limit')->nullable();
            $table->text('instruction')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
