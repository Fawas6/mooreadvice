<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Function to display the results for any individual polling units
    public function showTasks()
    {
        try {
            $tasks = Tasks::all();

            return view('task.all_tasks', compact('tasks'));
        }catch (\Exception $e) {
            // Returns error response if there's any error
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function createTask(Request $request) {
        if ($request->isMethod('post')) {
            try {
                // Retrieves the authenticated user
                // $user = Auth::user();
                //  We create tasks using the provided data
                //  We implement the logic to create tasks
                $request->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'description' => ['required', 'string', 'max:255'],
                ]);

                $taskInfo = Tasks::create([
                    // 'author' => $user->name,
                    'title' => $request->title,
                    'description' => $request->description,
                ]);

                $taskInfo->save();

                // Displays the success message after the task gets created
                $request->session()->flash('success', 'Task created successfully.');
            }catch (\Exception $e) {
                // Returns error response if there's any error
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }

        // Load the view if the request method is not POST
        return view('task.create_task');
}

public function editTask(Request $request) {
    if ($request->isMethod('post')) {
        try {
            // Implement the logic to update the task
            $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
            ]);

            // Update the description where the title matches
            Tasks::where('title', $request->title)
                ->update(['description' => $request->description]);

            // Display success message after updating the task
            $request->session()->flash('success', 'Task updated successfully.');

        } catch (\Exception $e) {
            // Return error response if there's any error
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    // Load the view for editing the task if the request method is not POST
    return view('task.edit_task');
}

public function deleteTask($id) {
    try {
        // Find the task by its ID
        $task = Tasks::find($id);

        if (!$task) {
            // Handle task not found
            return response()->json(['error' => true, 'message' => 'Task not found.'], 404);
        }

        // Implement logic to check the user's authorization to delete the task
        // For example, you can check if the authenticated user is the author of the task.

        // Delete the task
        $task->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Task deleted successfully');
    } catch (\Exception $e) {
        // Return an error response if there's any error
        return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
}

}
