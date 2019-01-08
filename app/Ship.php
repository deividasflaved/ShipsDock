<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = ['ship_name', 'ship_type_id', 'docking_slot_id', 'owner_name', 'owner_contacts', 'ship_arrival_date', 'ship_departure_date'];
}
