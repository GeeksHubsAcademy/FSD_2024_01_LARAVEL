<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        try {
            $tasks = Task::all();

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
        $title = $request->input('title');

        return 'CREATE TASK';
    }

    public function updateTaskById($id)
    {
        return 'update TASK ' . $id;
    }

    public function deleteTaskById($id)
    {
        return 'delete TASK' . $id;
    }
}
