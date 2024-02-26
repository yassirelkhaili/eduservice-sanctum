<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll()
    {
        return Task::all();
    }
    public function getById($id)
    {
        return Task::findOrFail($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $Task = $this->getById($id);
        $Task->update($data);
        return $Task;
    }

    public function delete($id)
    {
        $Task = $this->getById($id);
        $Task->delete();
    }
}