<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Get the authenticated user
        $totalPendingTasks = Task::query()
            ->where('status', 'pending')
            ->count();
        $myPendingTasks = Task::query()
            ->where('status', 'pending')
            ->where('assigned_user_id', $user->id)
            ->count();

        $totalProgressTasks = Task::query()
            ->where('status', 'in_progress')
            ->count();
        $myProgressTasks = Task::query()
            ->where('status', 'in_progress')
            ->where('assigned_user_id', $user->id)
            ->count();

        $totalCompletedTasks = Task::query()
            ->where('status', 'completed')
            ->count();
        $myCompletedTasks = Task::query()
            ->where('status', 'completed')
            ->where('assigned_user_id', $user->id)
            ->count();


        $totalHighPriorityTasks = Task::query()
            ->where('priority', 'high')
            ->count();
        $myHighPriorityTasks = Task::query()
            ->whereIn('status', ['pending', 'in_progress'])
            ->where('priority', 'high')
            ->where('assigned_user_id', $user->id)
            ->count();

        $activeTasks = Task::query()
            ->whereIn('status', ['pending', 'in_progress'])
            ->where('assigned_user_id', $user->id)
            ->limit(10)
            ->get();
        $activeTasks = TaskResource::collection($activeTasks);

        return inertia('Dashboard', [
            'auth' => ['user' => $user], // Ensure auth object is structured properly
            'totalPendingTasks' => $totalPendingTasks,
            'myPendingTasks' => $myPendingTasks,
            'totalProgressTasks' => $totalProgressTasks,
            'myProgressTasks' => $myProgressTasks,
            'totalCompletedTasks' => $totalCompletedTasks,
            'myCompletedTasks' => $myCompletedTasks,
            'totalHighPriorityTasks' => $totalHighPriorityTasks,
            'myHighPriorityTasks' => $myHighPriorityTasks,
            'activeTasks' => $activeTasks,
        ]);

        // return inertia('Dashboard', compact(
        //     'totalPendingTasks',
        //     'myPendingTasks',
        //     'totalProgressTasks',
        //     'myProgressTasks',
        //     'totalCompletedTasks',
        //     'myCompletedTasks',
        //     'totalHighPriorityTasks',
        //     'myHighPriorityTasks',
        //     'activeTasks',
        // ));
    }
}
