<?php

// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Defina os campos permitidos para atribuição em massa
    protected $fillable = ['nome', 'email', 'telefone', 'endereco'];
}
