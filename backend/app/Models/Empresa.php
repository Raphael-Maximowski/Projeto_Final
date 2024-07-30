<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'razao',
        'cnpj',
        'inscri_estadual',
        'fundacao',
        'admin_id'
    ];
    public function adminuser()
    {
        return $this->belongsTo(AdminUser::class);
    }



}
