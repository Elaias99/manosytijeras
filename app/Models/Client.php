<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'notes',
    ];

    public function coloProfile()
    {
        return $this->hasOne(ClientcoloProfile::class, 'client_id');
    }

    
}
