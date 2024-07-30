<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'admin_id',
        'team_id',
    
    ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        public function admin()
        {
            return $this->belongsTo(User::class, 'admin_id');
        }
    
        public function team()
        {
            return $this->belongsToMany(Team::class);
        }
}
