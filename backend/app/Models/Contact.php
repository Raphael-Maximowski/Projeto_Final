<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'posicao',
        'name',
        'phone',
        'email',
        'cpf',
        'data_de_nascimento',
        'endereco',
        'value',
        'step_id',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class, 'step_id');
    }

    public function updateContact(array $data)
    {
        if (isset($data['step_id'])) {
            $this->step_id = $data['step_id'];
        }
        if (isset($data['posicao'])) {
            $this->posicao = $data['posicao'];
        }
        $this->save();
    }
}
