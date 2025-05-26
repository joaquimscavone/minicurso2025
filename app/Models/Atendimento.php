<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    /** @use HasFactory<\Database\Factories\AtendimentoFactory> */
    use HasFactory;
    public $fillable = [ 'tecnico_id', 'servico_id', 'descricao' ];
    
    public function servico()
    {
        return $this->belongsTo(Servico::class, 'servico_id');
    }
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}
