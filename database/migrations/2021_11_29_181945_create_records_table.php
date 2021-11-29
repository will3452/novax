<?php

use App\Models\Record;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     'fasp_control_number',
        'fas_control_number',
        'job_type',
        'job_status',
        'fas_pic',
        'maker',
        'received_date',
        'fas_due_date',
        'fasp_due_date',
        'date_send',
        'status',
        'working_hours',
        'standard_time',
     **/
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('fasp_control_number')->unique();
            $table->string('fas_control_number')->unique();
            $table->string('job_type');
            $table->string('job_status')->default(Record::JOB_STATUS_NO_PROBLEM);
            $table->string('fas_pic')->nullable();
            $table->string('maker')->nullable();
            $table->timestamp('received_date')->nullable();
            $table->timestamp('fas_due_date')->nullable();
            $table->timestamp('fasp_due_date')->nullable();
            $table->timestamp('date_send')->nullable();
            $table->string('status')->nullable(Record::STATUS_PENDING);
            $table->string('working_hours')->nullable();
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
