<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class); // um funil pode pertencer a vários usuários
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class); // um funil pertence a uma coleção
    }

    public function team ()
    {
        return $this->belongsTo(Team::class);
    }

    public $timestamps = true;

    // Sobrescreve o método para definir created_at sem a parte da hora
    public function setCreatedAt($value)
    {
        $this->attributes[$this->getCreatedAtColumn()] = Carbon::now()->toDateString();
    }

    // Sobrescreve o método para retornar a coluna de created_at formatada
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Opcional: Sobrescreve o método para retornar a coluna de created_at
    public function getCreatedAtColumn()
    {
        return 'created_at';
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }
}


