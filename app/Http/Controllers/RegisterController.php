<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Repositories\CategoryRepository;
use App\Repositories\RegisterRepository;
use App\Repositories\SubCategoryRepository;
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
    public function store(Request $request)
    {
        // 1. Validamos los campos comunes
        $data = $request->validate([
            'user_id'        => 'required|numeric',
            'account_id'     => 'required|numeric',
            'amount'         => 'required|numeric',
            'origin'         => 'required|string',
            'objectiveId'    => 'nullable|integer|exists:objectives,id',
            'subcategory_id' => 'nullable|integer|exists:subcategories,id',
            'periodicId'     => 'nullable|integer|exists:periodics,id',
            'limit'          => 'nullable|numeric',
        ]);
        $register = null;
        // 2. Determinamos el tipo de registro
        if (! empty($data['periodicId'])) {
            // Registro recurrente
            //$register = $this->registerRepository->createRecurrent($request->route('id'), $data);
        }
        elseif (! empty($data['objectiveId'])) {
            // Registro normal asociado a un objetivo
            //$register = $this->registerRepository->createWithObjective($request->route('id'), $data);
        }
        elseif (! empty($data['limit'])) {
            // Registro normal con un límite
            //$register = $this->registerRepository->createWithLimit($request->route('id'), $data);
        }
        else {
            $data['name_category'] = SubCategoryRepository::findNameByCatSubcatId($data['subcategory_id']);
            $register = RegisterRepository::createNormal($data);
        }

        return response()->json([
            'register' => $register
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'user_id'        => 'required|numeric',
            'account_id'     => 'required|numeric',
            'amount'         => 'required|numeric',
            'origin'         => 'required|string',
            'objectiveId'    => 'nullable|integer|exists:objectives,id',
            'subcategory_id' => 'nullable|integer|exists:subcategories,id',
            'periodicId'     => 'nullable|integer|exists:periodics,id',
            'limit'          => 'nullable|numeric',
        ]);
        return RegisterRepository::update($data, $id);
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
}
