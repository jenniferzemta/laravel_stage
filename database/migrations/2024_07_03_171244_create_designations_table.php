<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->timestamps();
        });
        DB::table('departments')->insert([
           /**  ['department' => 'Web Department'],
           * ['department' => 'IT Management'],
           * ['department' => 'Marketing'],*/
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('designations');
    }
}
