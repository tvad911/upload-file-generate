<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LeaseContractCreateLeaseContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lease_contract_files', function (Blueprint $table) {
            $table->id();
            $table->integer('lease_contract_id', false, true);
            $table->integer('user_id')->unsigned()->references('id')->on('users')->index();
            $table->string('name', 255);
            $table->string('folder', 255)->nullable();
            $table->string('mime_type', 120);
            $table->integer('size');
            $table->string('url', 255);
            $table->text('options')->nullable();
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
        Schema::dropIfExists('lease_contract_files');
    }
}
