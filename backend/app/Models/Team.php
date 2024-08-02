<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'empresa_id', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function company()
    {
        return $this->hasOne(Empresa::class);
    }

    public function admin()
    {
        return $this->hasOne(AdminUser::class);
    }

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }

    public function funnels()
    {
        return $this->hasMany(Funnel::class);
    }
}


