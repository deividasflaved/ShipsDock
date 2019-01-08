<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DockSlots extends Model
{
    protected $fillable = ['is_empty', 'price_per_day'];
}
