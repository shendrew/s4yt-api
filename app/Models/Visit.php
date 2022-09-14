<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Visit extends Pivot
{
    public function scopeEventPartner($query, $event_partner_id)
    {
        return $query->where('event_partner_id', $event_partner_id);
    }

    public function scopePlayer($query, $player_id)
    {
        return $query->where('player_id', $player_id);
    }
}
