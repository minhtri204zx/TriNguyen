<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'content',  'account_id'];

    public function getCountAttribute(){
        return Noti::where('account_id', $this->account_id)->count(); 
    }
}
