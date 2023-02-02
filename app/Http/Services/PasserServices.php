<?php

namespace App\Http\Services;

use App\Models\Passers;

class PasserServices {

    public function search_passer($data)
    {
        $passers = Passers::whereHas('employee', function($query) use($data){
            $query->where('full_name', 'LIKE', '%'.$data.'%');
        })
        ->orWhereHas('employee', function($query) use($data){
            $query->where('gender', 'LIKE', '%'.$data.'%');
        })
        ->orWhereHas('employee.position', function($query) use($data){
            $query->where('position_name', 'LIKE', '%'.$data.'%');
        })
        ->with(['employee','employee.position'])
        ->paginate(10);

        return $passers;
    }
}