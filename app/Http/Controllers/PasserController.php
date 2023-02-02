<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passers;
use App\Models\Employee;
use App\Http\Resources\PassersResource;
use Illuminate\Support\Facades\DB;

use App\Http\Services\PasserServices;

class PasserController extends Controller
{
    protected $passerServices;

    public function __construct(PasserServices $passerServices)
    {
        $this->passerServices = $passerServices;
    }

    public function get_all(Request $request)
    {
        $searchQuery = $request->searchPasser;

        $passers = $this->passerServices->search_passer($searchQuery);

        return PassersResource::collection($passers);
    }
}
