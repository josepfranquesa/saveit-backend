<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Periodic;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Register the command
|--------------------------------------------------------------------------
*/
Artisan::command('periodics:process', function () {
    $this->info('[' . Carbon::now()->toDateTimeString() . '] Iniciando proceso de registros periódicos');

    RegisterController::checkPeriodics();

    $this->info('Proceso de registros periódicos finalizado.');
    return 0;
})->describe('Busca y procesa todos los registros periódicos');

/*
|--------------------------------------------------------------------------
| Schedule the command
|--------------------------------------------------------------------------
|
| Definimos que se ejecute cada día a las 05:00 horas.
|
*/
Schedule::command('periodics:process')
        ->dailyAt('05:00')
        ->timezone('Europe/Madrid')
        ->withoutOverlapping()
        ->appendOutputTo(storage_path('logs/periodics.log'));
