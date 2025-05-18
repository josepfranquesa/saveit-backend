<?php

namespace App\Http\Controllers;

use App\Repositories\PeriodicRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(Array $data)
    {
        $baseDate = isset($data['created_at']) ? Carbon::parse($data['created_at']) : Carbon::now();
        switch ($data['periodic_unit']) {
            case 'Días':
                $next = $baseDate->copy()->addDay();
                break;
            case 'Semanas':
                $next = $baseDate->copy()->addWeek();
                break;
            case 'Meses':
                $next = $baseDate->copy()->addMonth();
                break;
            default:
                $next = $baseDate->copy();
                break;
        }
        $data['created_at'] = $next->toDateTimeString();
        return PeriodicRepository::create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
