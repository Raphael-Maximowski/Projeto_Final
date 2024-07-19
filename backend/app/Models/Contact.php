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

    public function updateStep($request)
    {
        $this->step_id = $request['step_id'];
        $this->save();
    }
}
