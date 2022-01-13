<?php

use App\Models\UserRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->onDelete('set null');
            $table->foreignId('document_id')
                ->nullable()
                ->onDelete('set null');
            $table->string('name');
            $table->string('document');
            $table->string('amount');
            $table->string('description');
            $table->string('proof_of_payment');
            $table->string('status')->default(UserRequest::STATUS_UNRESOLVED);
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
        Schema::dropIfExists('user_requests');
    }
}
