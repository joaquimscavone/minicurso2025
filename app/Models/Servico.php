<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    /** @use HasFactory<\Database\Factories\ServicoFactory> */
    use HasFactory;
    public $fillable = [ 'cliente_id', 'situacao', 'titulo', 'descricao' ];
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }
    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'servico_id');
    }
}
