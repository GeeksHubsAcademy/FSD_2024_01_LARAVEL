<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        try {
            $tasks = Task::query()
                ->select('id', 'title', 'description', 'user_id')
                // ->where('user_id', auth()->user()->id)
                ->get();



            return response()->json(
                [
                    "success" => true,
                    "message" => "Tasks retrieved successfully",
                    "data" => $tasks
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Tasks cant be retrieved successfully",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function createTask(Request $request)
    {
        try {
            $task = new Task;
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->user_id = auth()->user()->id;

            $task->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Tasks created successfully",
                    "data" => $task
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Tasks cant be created task",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function updateTaskById(Request $request, $id)
    {
        try {
            $taskId = $id;

            $taskTitle = $request->input('title');
            $taskDescription = $request->input('description');
            $taskStatus = $request->input('status');

            $task = Task::find($taskId);

            // validar que existe la tarea

            if ($taskTitle) {
                $task->title = $taskTitle;
            }

            if ($taskStatus) {
                $task->status = $taskStatus;
            }

            if ($taskDescription) {
                $task->description = $taskDescription;
            }

            $task->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Tasks deleted successfully",
                    "data" => $task
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Tasks cant be updated",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function deleteTaskById($id)
    {
        try {
            $taskDeleted = Task::destroy($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Tasks deleted successfully",
                    "data" => $taskDeleted
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Tasks cant be deleted task",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }

    public function getTaskById(Request $request, $id)
    {
        try {
            $task = Task::find($id);

            return response()->json(
                [
                    "success" => true,
                    "message" => "Task retrieved successfully",
                    "data" => $task->user
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Task cant be retrieved",
                    "error" => $th->getMessage()
                ],
                500
            );
        }
    }
}
