<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_produtos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco_unitario', 8, 2);
            $table->enum('categoria', ['paes', 'bolos', 'doces', 'salgados', 'sobremesas']);
            $table->integer('estoque');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
