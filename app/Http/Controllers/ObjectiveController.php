<?php

namespace App\Http\Controllers;

use App\Repositories\ObjectiveRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function storeObjective(Request $request)
    {
        $validated = $request->validate([
            'creator_id'     => ['required', 'exists:users,id'],
            'account_id'     => ['exists:accounts,id'],
            'total'          => ['nullable', 'numeric', 'min:0'],
            'title'          => ['nullable', 'string', 'max:255'],
        ]);

        $data = [
            'user_id'        => $validated['creator_id'],
            'account_id'     => $validated['account_id']     ?? null,
            'type'           => 'GOAL',
            'amount'         => 0,
            'total'         => $validated['total'],
            'title'          => $validated['title']          ?? null,
        ];

        $objective = ObjectiveRepository::findObjectiveByNameAccount($data['account_id'], $data['title']);
        if ($objective) {
            return response()->json([
                'message' => 'Ya existe un objetivo con este nombre para esta cuenta'
            ], 409);
        } else {
            $objective = ObjectiveRepository::createObjective($data);
            return response()->json([
                'message'   => 'Objective created successfully',
                'objective' => $objective,
            ], 201);
        }
    }


    public function storeLimit(Request $request)
    {
        $validated = $request->validate([
            'creator_id'     => ['required', 'exists:users,id'],
            'account_id'     => ['exists:accounts,id'],
            'subcategory_id' => ['exists:subcategories,id'],
            'total'          => ['required', 'numeric', 'min:0'],
        ]);

        $data = [
            'user_id'        => $validated['creator_id'],
            'account_id'     => $validated['account_id']     ?? null,
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'type'           => 'LIMIT',
            'total'          => $validated['total'],
            'amount'         => 0,
        ];

        $objective = ObjectiveRepository::findLimitBySubcatAccount($data['account_id'], $data['subcategory_id']);
        if ($objective) {
            return response()->json([
                'message' => 'Ya existe un limite para esta categoria o subcategoria'
            ], 409);
        } else {
            $data['limit_name'] = SubCategoryRepository::findNameByCatSubcatId($data['subcategory_id']);
            $objective = ObjectiveRepository::createObjective($data);
            return response()->json([
                'message'   => 'Limit created successfully',
                'objective' => $objective,
            ], 201);
        }
    }

    public function getGoalAccount($account_id)
    {
        $goals = ObjectiveRepository::findObjectiveByAccount($account_id, "GOAL");

        return response()->json([
            'account_id' => $account_id,
            'type'       => 'GOAL',
            'objectives' => $goals,
        ], 200);
    }

    public function getLimitAccount($account_id)
    {
        $goals = ObjectiveRepository::findObjectiveByAccount($account_id, "LIMIT");

        return response()->json([
            'account_id' => $account_id,
            'type'       => 'LIMIT',
            'objectives' => $goals,
        ], 200);
    }

    public function destroyObjectiveAccount($id){
        $objective = ObjectiveRepository::findById($id);
        if($objective){
            ObjectiveRepository::deleteObjective($id);
            return response()->json(['message' => 'Objetivo eliminado correctamente']);
        }
        else return response()->json(['message' => 'No se ha podido eliminar el objetivo']);
    }


}
