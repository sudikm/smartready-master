<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('mobile', 50)->nullable()->after('password');
            $table->string('postcode', 50)->nullable()->after('mobile');
            $table->string('model', 50)->nullable()->after('postcode');
            $table->string('windows', 50)->nullable()->after('model');
            $table->string('doors', 50)->nullable()->after('windows');
            $table->longText('license')->nullable()->after('doors');
            $table->string('emailConfirmPin', 100)->nullable()->after('license');
            $table->string('smsConfirmPin', 100)->nullable()->after('emailConfirmPin');
            $table->enum('emailConfirm', ['Yes', 'No'])->default('No');;
            $table->enum('smsConfirm', ['Yes', 'No'])->default('No');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('mobile');
            $table->dropColumn('postcode');
            $table->dropColumn('model');
            $table->dropColumn('windows');
            $table->dropColumn('doors');
            $table->dropColumn('license');
            $table->dropColumn('emailConfirmPin');
            $table->dropColumn('smsConfirmPin');
            $table->dropColumn('emailConfirm');
            $table->dropColumn('smsConfirm');
        });
    }
}
