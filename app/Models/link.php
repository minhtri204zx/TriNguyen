<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class link extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['id', 'link', 'shorten', 'account_id'];

    public function getUrlAttribute()
    {
        return 'http://127.0.0.1:8000/' . $this->shorten;
    }
    public function getClickAttribute() 
    {
        return $this->viewers()->count();
    }

    public function viewers(): HasMany 
    {
        return $this->hasMany(Viewer::class);
    }

    

}
