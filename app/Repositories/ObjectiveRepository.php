<?php

namespace App\Repositories;

use App\Models\Objective;

class ObjectiveRepository
{
    public static function createObjective(array $data): Objective
    {
        return Objective::create($data);
    }

    public static function findObjectiveByNameAccount($account_id, $title){
        return Objective::where('account_id', $account_id)
        ->where('title', $title)
        ->where('type',"GOAL")
        ->first();
    }

    public static function findLimitBySubcatAccount($account_id, $subcategory_id){
        return Objective::where('account_id', $account_id)
        ->where('subcategory_id', $subcategory_id)
        ->where('type',"LIMIT")
        ->first();
    }


    public function findObjectiveById($id)
    {
        // Buscar un objetivo por ID
    }

    public function updateObjective($id, array $data)
    {
        // Actualizar un objetivo
    }

    public function deleteObjective($id)
    {
        // Eliminar un objetivo
    }
}
