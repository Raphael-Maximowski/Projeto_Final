<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class); //um funil pode pertencer a vários usuários
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class); //um funil pode estar associado a várias coleções
    }
}


