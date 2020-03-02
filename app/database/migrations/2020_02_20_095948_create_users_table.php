<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(); // Priscila Martins de Souza
            $table->string('number')->nullable(); // 1729862
            $table->string('is_active')->nullable(); // Sim
            $table->string('cpf')->nullable(); // 11462236685
            $table->string('rg')->nullable(); // 17641187
            $table->string('is_accredited')->nullable(); // Não
            $table->string('driver_category')->nullable(); // 
            $table->char('gender')->nullable(); // F
            $table->date('birth_date')->nullable(); // 1993/11/10
            $table->date('inclusion_date')->nullable(); // 2017/03/30
            $table->string('quadro')->nullable(); // QPEBM
            $table->string('posto_grad')->nullable(); // SD
            $table->string('functional_situation')->nullable(); // ATIVIDADE MEIO
            $table->string('unity')->nullable(); // DLF/SDTS/NTS/INFORMATICA
            $table->string('unity_code')->nullable(); // 9410
            $table->string('main_unity')->nullable(); // DLF
            $table->string('main_unity_code')->nullable(); // 9391
            $table->string('pilot_license_category')->nullable(); // 
            $table->date('recadastration_date')->nullable(); // 9999/12/31 00:00:00
            $table->date('last_update')->nullable(); // 2020/02/10 03:50:40
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
        Schema::dropIfExists('users');
    }
}
