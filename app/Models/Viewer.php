<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\link;

class Viewer extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'link_id', 'device', 'media', 'platform', 'country', 'ip', 'city', 'lat', 'lon'];
    
    public function getAbcAttribute() 
    {
        return Viewer::where([
            ['country', $this->country],
            ['link_id', $this->link_id],
        ])->count();
    }

}
