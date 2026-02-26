<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientcoloProfile extends Model
{
    //
    protected $table = 'client_color_profiles';


    protected $fillable = [
        'client_id',
        'base_level',
        'goal_tone',
        'brand',
        'color_code',
        'formula',
        'developer_volume',
        'ratio',
        'processing_time_minutes',
        'technique',
        'warnings',
        'notes',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
