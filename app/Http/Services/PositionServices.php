<?php

namespace App\Http\Services;

use App\Models\Position;

class PositionServices {

    public function search_position($data)
    {
        $query = Position::where('position_name', 'LIKE', '%'.$data.'%')
        ->orWhere('id', 'LIKE', '%'.$data.'%')
        ->paginate(10);

        return $query;
    }
}