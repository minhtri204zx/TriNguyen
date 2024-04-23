<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'link', 'shorten','account_id','click',];

}
