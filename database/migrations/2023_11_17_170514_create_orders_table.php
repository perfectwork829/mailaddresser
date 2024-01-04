<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedInteger('matching_records')->nullable();
            $table->unsignedInteger('number_to_purchase');
            $table->string('discount_code', 25)->nullable();
            $table->string('path', 100)->nullable();

            $table->string('gender', 1)->nullable();
            $table->string('age')->nullable();
            $table->text('geography')->nullable();
            $table->string('living_type')->nullable();
            $table->string('phone_numbers')->nullable();
            $table->text('exclude')->nullable();

            $table->string('first_name', 25)->nullable();
            $table->string('last_name', 25)->nullable();
            $table->string('company_name', 50)->nullable();
            $table->string('organization_number', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('postal_address', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('zip', 25)->nullable();
            $table->string('area', 25)->nullable();
            $table->enum('payment_option', ['payson', 'invoice', 'billmate'])->default('billmate');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('nix_validation')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
