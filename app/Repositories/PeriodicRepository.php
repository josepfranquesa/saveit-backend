<?php
namespace App\Repositories;

use App\Models\Periodic;

class PeriodicRepository
{
    public function getAll()
    {
        return Periodic::all();
    }

    public function getById($id)
    {
        return Periodic::findOrFail($id);
    }

    public static function create(array $data)
    {
        return Periodic::create([
            'periodic_interval'   => $data['periodic_interval'],
            'periodic_unit'       => $data['periodic_unit'],
            'origen_time_created' => $data['created_at'],
            'created_at'          => now(),
            'updated_at'          => now(),
            'register_id'         => $data['id'],
        ]);
    }

    public function update($id, array $data)
    {
        $periodic = Periodic::findOrFail($id);
        $periodic->update($data);
        return $periodic;
    }

    public function delete($id)
    {
        return Periodic::destroy($id);
    }
}
