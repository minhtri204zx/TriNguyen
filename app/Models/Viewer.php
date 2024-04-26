<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'link_id', 'device', 'media', 'platform', 'country','ip','city','lat','lon'];
}
