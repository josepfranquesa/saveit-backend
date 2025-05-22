<?php
namespace App\Repositories;

use App\Http\Controllers\AccountController;
use App\Models\Register;
use Carbon\Carbon;

class RegisterRepository
{
    public function getAll()
    {
        return Register::all();
    }

    public static function find($id)
    {
        return Register::findOrFail($id);
    }

    public function create(array $data)
    {
        return Register::create($data);
    }

    public static function update(array $data, $id)
    {
        $register = Register::findOrFail($id);
        $register->update($data);
        return $register;
    }

    public static function delete($id)
    {
        $register = Register::findOrFail($id);
        if ($register->objective_id) {
            $objective = ObjectiveRepository::findById($register->objective_id);
            if($objective->amount -= $register->amount <= 0){
                $objective->amount = 0;
            }
            else{
                $objective->amount -= $register->amount;
            }
            $objective->save();
        }
        AccountController::updateAccountBalance($register->account_id, $register->amount);
        return Register::destroy($id);
    }

    public function getByAccountId($accountId)
    {
        return Register::where('account_id', $accountId)->orderBy('created_at', 'desc')->get();
    }

    public static function createNormal($data)
    {
        return Register::create([
            'user_id'        => $data['user_id'],
            'account_id'     => $data['account_id'],
            'objective_id'   => $data['objective_id'] ?? null,
            'amount'         => $data['amount'],
            'origin'         => $data['origin'],
            'subcategory_id' => $data['subcategory_id'] ?? null,
            'name_category'  => $data['name_category'] ?? null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    public static function findByAcountSubcategory($id_subCat, $accountId){
        return Register::where('account_id', $accountId)->where('subcategory_id', $id_subCat)->orderBy('created_at', 'desc')->get();
    }

    public static function getAmountForGraph($data)
    {
        $start = Carbon::parse($data->start_date)->startOfDay();
        $end   = Carbon::parse($data->end_date)->endOfDay();

        $query = Register::where('account_id', $data->account_id)
            ->whereBetween('created_at', [$start, $end]);

        if (!empty($data->category_ids) && is_array($data->category_ids)) {
            $query->whereIn('subcategory_id', $data->category_ids);
        }

        return (float) $query->sum('amount');
    }
}
