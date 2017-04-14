<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayHabitPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_habit', function (Blueprint $table) {
            $table->integer('day_id')->unsigned()->index();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->integer('habit_id')->unsigned()->index();
            $table->foreign('habit_id')->references('id')->on('habits')->onDelete('cascade');
            $table->boolean('fulfilled')->default(false);
            $table->primary(['day_id', 'habit_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('day_habit');
    }
}
