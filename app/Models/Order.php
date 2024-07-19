<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'kitchen_id',
        'menu_id',
        'rider_id',
        'status',
        'call_upon_arrival',
        'ring_the_doorbell',
        'notes',
    ];

    // Define relationships if needed
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
