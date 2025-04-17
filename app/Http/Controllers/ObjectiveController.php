<?php

namespace App\Http\Controllers;

use App\Repositories\ObjectiveRepository;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    public function storeObjective(Request $request)
    {
        $validated = $request->validate([
            'creator_id'     => ['required', 'exists:users,id'],
            'account_id'     => ['exists:accounts,id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,id'],
            'amount'         => ['required', 'numeric', 'min:0'],
            'title'          => ['nullable', 'string', 'max:255'],
        ]);

        $data = [
            'user_id'        => $validated['creator_id'],
            'account_id'     => $validated['account_id']     ?? null,
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'type'           => 'GOAL',
            'amount'         => $validated['amount'],
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
            'amount'         => ['required', 'numeric', 'min:0'],
        ]);

        $data = [
            'user_id'        => $validated['creator_id'],
            'account_id'     => $validated['account_id']     ?? null,
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'type'           => 'LIMIT',
            'amount'         => $validated['amount'],
        ];

        $objective = ObjectiveRepository::findLimitBySubcatAccount($data['account_id'], $data['subcategory_id']);
        if ($objective) {
            return response()->json([
                'message' => 'Ya existe un limite para esta categoria o subcategoria'
            ], 409);
        } else {
            $objective = ObjectiveRepository::createObjective($data);
            return response()->json([
                'message'   => 'Limit created successfully',
                'objective' => $objective,
            ], 201);
        }
    }

    public function getObjectiveAccount($id)
    {

    }

    public function getLimitAccount($id)
    {

    }

}
