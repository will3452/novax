<?php

use App\Models\Record;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('customer_control_number')->unique();
            $table->string('company_control_number')->unique();
            $table->string('job_type');
            $table->string('job_status')->default(Record::JOB_STATUS_NO_PROBLEM);
            $table->string('maker')->nullable();
            $table->timestamp('received_date')->nullable();
            $table->timestamp('customer_due_date')->nullable();
            $table->timestamp('company_due_date')->nullable();
            $table->timestamp('date_send')->nullable();
            $table->string('status')->nullable(Record::STATUS_ON_GOING);
            $table->string('standard_time');
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
        Schema::dropIfExists('records');
    }
}
