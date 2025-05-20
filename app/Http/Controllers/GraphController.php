<?php

namespace App\Http\Controllers;

use App\Repositories\GraphRepository;
use App\Repositories\RegisterRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class GraphController extends Controller
{

    public function getInfoForGraph(Request $request)
    {
        $params = $request->only([
            'account_id',
            'start_date',
            'end_date',
            'category_ids',
            'periodo'
        ]);

        $start  = Carbon::parse($params['start_date']);
        $end    = Carbon::parse($params['end_date']);
        $labels = [];
        $data   = [];

        switch ($params['periodo']) {
            case 'PeriodType.day':
                // 24 horas del mismo día
                for ($h = 0; $h < 24; $h++) {
                    $labels[] = sprintf('%02d:00', $h);

                    $sliceStart = $start->copy()->hour($h)->minute(0)->second(0);
                    $sliceEnd   = $start->copy()->hour($h)->minute(59)->second(59);

                    $params['start_date'] = $sliceStart->toDateTimeString();
                    $params['end_date']   = $sliceEnd->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            case 'PeriodType.week':
                // Un rango de días — uno por cada día entre start y end
                // Etiquetas con nombre de día (en español)
                foreach (CarbonPeriod::create($start->copy()->startOfDay(), '1 day', $end->copy()->startOfDay()) as $day) {
                    // Día de la semana en español, p.ej. "Lunes"
                    $labels[] = ucfirst($day->locale('es')->isoFormat('dddd'));

                    $params['start_date'] = $day->copy()->startOfDay()->toDateTimeString();
                    $params['end_date']   = $day->copy()->endOfDay()->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            case 'PeriodType.month':
                // Cada día del mes
                foreach (CarbonPeriod::create($start->copy()->startOfDay(), '1 day', $end->copy()->startOfDay()) as $day) {
                    // Número de día: "01", "02", …
                    $labels[] = $day->format('d');

                    $params['start_date'] = $day->copy()->startOfDay()->toDateTimeString();
                    $params['end_date']   = $day->copy()->endOfDay()->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            case 'PeriodType.quarter':
                // Cada mes en el trimestre
                foreach (CarbonPeriod::create($start->copy()->startOfMonth(), '1 month', $end->copy()->startOfMonth()) as $month) {
                    // Etiqueta: p.ej. "Ene 2025"
                    $labels[] = ucfirst($month->locale('es')->isoFormat('MMM YYYY'));

                    $params['start_date'] = $month->copy()->startOfMonth()->toDateTimeString();
                    $params['end_date']   = $month->copy()->endOfMonth()->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            case 'PeriodType.year':
                // Cada mes en el año
                foreach (CarbonPeriod::create($start->copy()->startOfMonth(), '1 month', $end->copy()->startOfMonth()) as $month) {
                    $labels[] = ucfirst($month->locale('es')->isoFormat('MMM YYYY'));

                    $params['start_date'] = $month->copy()->startOfMonth()->toDateTimeString();
                    $params['end_date']   = $month->copy()->endOfMonth()->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            case 'PeriodType.custom':
                // Igual que mensual, pero con rango arbitrario
                foreach (CarbonPeriod::create($start->copy()->startOfDay(), '1 day', $end->copy()->startOfDay()) as $day) {
                    $labels[] = $day->format('Y-m-d');

                    $params['start_date'] = $day->copy()->startOfDay()->toDateTimeString();
                    $params['end_date']   = $day->copy()->endOfDay()->toDateTimeString();

                    $data[] = RegisterRepository::getAmountForGraph((object)$params);
                }
                break;

            default:
                return response()->json([
                    'error' => 'Periodo no reconocido'
                ], 422);
        }

        $graphic = GraphRepository::create([
            'account_id' => $request['account_id'],
            'periodo'    => $request['periodo'],
            'start_date' => $request['start_date'],
            'end_date'   => $request['end_date'],
            'labels'     => $labels,
            'data'       => $data,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json($graphic, 201);
    }

    public function getGraphs(int $acount){
        return GraphRepository::findByAccountId($acount);
    }

    public function destroyGraph(int $id){
        $graphic = GraphRepository::findById($id);
        GraphRepository::delete($graphic);
        return response()->json(['message' => 'Gráfico eliminado'], 200);
    }
}
