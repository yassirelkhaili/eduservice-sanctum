<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll()
    {
        return Task::where('user_id', Auth::id())->get();;
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
        $task = $this->getById($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        $Task = $this->getById($id);
        $Task->delete();
    }
}