<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;

class link extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'link', 'shorten', 'account_id', 'infor',];

    public function getUrlAttribute()
    {
        return 'http://127.0.0.1:8000/' . $this->shorten;
    }

    public function getStatusAttribute()
    {
        // $response = Http::head($this->link);

        // return !$response->failed() ? ['success','alive'] :['danger','die'];
        return ['success','alive'];
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
