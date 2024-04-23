<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        return 'GET ALL TASKS';
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
