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
        try {
            $task = new Task;
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->user_id = $request->input('user_id');

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

    public function updateTaskById($id)
    {
        return 'update TASK ' . $id;
    }

    public function deleteTaskById($id)
    {
        return 'delete TASK' . $id;
    }
}
