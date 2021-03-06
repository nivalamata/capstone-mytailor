<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFabricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblFabric', function (Blueprint $table) {
            $table->string('strFabricID')->primary();   
            $table->string('strFabricTypeFK')->index();//fk
            $table->string('strFabricPatternFK')->index();//fk
            $table->string('strFabricColorFK')->index();//fk
            $table->string('strFabricThreadCountFK')->index();//fk
            $table->string('strFabricName');
            $table->double('dblFabricPrice');
            $table->string('strFabricCode');
            $table->string('strFabricImage')->nullable();
            $table->text('txtFabricDesc')->nullable();
            $table->string('strFabricInactiveReason')->nullable();
            $table->boolean('boolIsActive');
            $table->timestamps();

            $table->foreign('strFabricTypeFK')
                  ->references('strFabricTypeID')
                  ->on('tblFabricType');
                  
            $table->foreign('strFabricPatternFK')
                  ->references('strFabricPatternID')
                  ->on('tblFabricPattern');

            $table->foreign('strFabricColorFK')
                  ->references('strFabricColorID')
                  ->on('tblFabricColor');

            $table->foreign('strFabricThreadCountFK')
                  ->references('strFabricThreadCountID')
                  ->on('tblFabricThreadCount');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tblFabric');
    }
}
