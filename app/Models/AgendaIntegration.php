<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaIntegration extends Model
{
    protected $fillable = [
        'base_url', 'username', 'access_token', 'refresh_token', 'selected_calendars', 'connected_at'
    ];

    protected $casts = [
        'selected_calendars' => 'array',
        'connected_at' => 'datetime',
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted',
    ];
}