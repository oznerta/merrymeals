<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\Kitchen;
use App\Models\Menu;

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

    // Define relationships
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function kitchen()
    {
        return $this->belongsTo(Kitchen::class, 'kitchen_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
