<?php

namespace App\Http\Controllers;

use App\Models\Periodic;
use App\Models\Register;
use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\ObjectiveRepository;
use App\Repositories\RegisterRepository;
use App\Repositories\SubCategoryRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //"The creator id field is required."
    {
        // 1. Validamos los campos comunes
        $data = $request->validate([
            'user_id'         => 'required|numeric',
            'account_id'      => 'required|numeric',
            'amount'          => 'required|numeric',
            'origin'          => 'required|string',
            'objective_id'     => 'nullable|integer|exists:objectives,id',
            'objective_amount' => 'nullable|numeric',
            'subcategory_id'  => 'nullable|integer|exists:subcategories,id',
            'periodic_interval' => 'nullable|integer|min:1',
            'periodic_unit'     => 'nullable|string|in:Días,Semanas,Meses',
        ]);
        $message = 'Registero creado con exito';
        if (! empty($data['objective_id']) && isset($data['objective_amount'])) {
            $objective = ObjectiveRepository::findById($data['objective_id']);
            if(($objective->amount + $data['objective_amount']) <= $objective->total){
                $objective->amount += $data['objective_amount'];
            }else{
                $objective->amount = $objective->total;
                $message = $message.'. Has conseguido un objetivo';
            }
            $objective->save();
        }
        $response = null;

        if (!empty($data['subcategory_id'])) {
            $data['name_category'] = SubCategoryRepository::findNameByCatSubcatId($data['subcategory_id']);

            if ($data['amount'] < 0) {
                $response = SubCategoryRepository::checkLimit($data['subcategory_id'], $data['amount']);
            }

            if (!empty($response) && !empty($response['message'])) {
                $message .= '. ' . $response['message'];
            }
        }

        $register = RegisterRepository::createNormal($data);
        AccountController::updateAccountBalance($data['account_id'], $data['amount']);

        if (isset($data['periodic_interval'], $data['periodic_unit'])) {
            $periodic = PeriodicController::store($register->toArray(), $data['periodic_interval'], $data['periodic_unit']);
            $data['periodic_id'] = $periodic->id;
            $message = $message.'. '.'Has programado este registro para el futuro con exito';
        }

        return response()->json([
            'message' => $message,
            'register' => $register
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return RegisterRepository::delete($id);
    }

    public static function updateCategory($register_id, $cat_subcat_id){
        $register = RegisterRepository::find($register_id);
        $name_category = SubCategoryRepository::findNameByCatSubcatId($cat_subcat_id);
        $register->subcategory_id = $cat_subcat_id;
        $register->name_category = $name_category;
        $register->save();
        return $register;
    }

    public function getRegistersForAccount($id)
    {
        $registers = $this->registerRepository->getByAccountId($id);
        return response()->json($registers);
    }

    public function getTotalsNoCategory(int $accountId): array
    {
        // Sumamos por separado los montos positivos y negativos, filtrando subcategory_id null
        $positiveTotal = Register::where('account_id', $accountId)
            ->whereNull('subcategory_id')
            ->where('amount', '>', 0)
            ->sum('amount');

        $negativeTotal = Register::where('account_id', $accountId)
            ->whereNull('subcategory_id')
            ->where('amount', '<', 0)
            ->sum('amount');

        // Nos aseguramos de devolver 0.0 si no hay registros
        return [
            'despesaNoCategory' => (float) $negativeTotal,
            'ingresoNoCategory' => (float) $positiveTotal,
        ];
    }

    public static function checkPeriodics(){
        $periodics = Periodic::whereNotNull('register_id')->where([['periodic_interval', '>', 0],])->get();
        foreach ($periodics as $periodic) {
            if($periodic->origen_time_created == today()){
                $register = Register::find($periodic->register_id);
                return Register::create([
                    'user_id'        => $register['user_id'],
                    'account_id'     => $register['account_id'],
                    'amount'         => $register['amount'],
                    'origin'         => $register['origin'],
                    'subcategory_id' => $register['subcategory_id'] ?? null,
                    'name_category'  => $register['name_category'] ?? null,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);

                $periodic->periodic_interval--;

                $baseDate = Carbon::now();

                // 2. Calculamos la siguiente fecha según la unidad periódica
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
                $periodic->origen_time_created = $next->toDateTimeString();
                $periodic->save();
            }
        }
    }
}
