<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{
    use JsonResponse;
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskRepository->getAll();
        return $this->successResponse($tasks, "Tasks fetched successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskRepository->create($request->all());
        return $this->successResponse($task, "Task created successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Assuming the Task model's primary key is named `id`.
        $task = $this->taskRepository->getById($task->id);
        return $this->successResponse($task, "Task fetched successfully", 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        // Assuming that $task->id gives the id of the task.
        $updatedTask = $this->taskRepository->update($task->id, $request->all());
        return $this->successResponse($updatedTask, "Task updated successfully", 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize("delete", $task);
        $this->taskRepository->delete($task->id);
        return $this->successResponse(null, "Task deleted successfully", 200);
    }
}
