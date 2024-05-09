<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class account extends Authenticatable
{
    use HasFactory;
    use Notifiable;


    protected $table= 'accounts';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'email',
        'password',
        'maxacthuc',
        'verifyEmail'
    ];

    public function links(): HasMany 
    {
        return $this->hasMany(Link::class);
    }

}
