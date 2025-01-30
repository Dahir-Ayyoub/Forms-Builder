<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeDeleteToFormFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('form_fields', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['form_id']);
            
            // Add the foreign key constraint with cascade delete
            $table->foreign('form_id')
                  ->references('id')->on('forms')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('form_fields', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['form_id']);
            
            // Restore the previous foreign key constraint without cascade
            $table->foreign('form_id')
                  ->references('id')->on('forms');
        });
    }
}