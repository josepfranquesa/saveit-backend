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

    public function create(array $data)
    {
        return Periodic::create($data);
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
