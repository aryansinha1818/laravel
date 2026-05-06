<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Task;

class CheckTaskOwner
{
    public function handle(Request $request, Closure $next)
    {
        $task = $request->route('task');

        // In real app, check user_id - simplified for demo
        // For demo, we'll check if task exists
        if (!$task) {
            return redirect()->route('tasks.index')
                ->with('error', 'Task not found!');
        }

        return $next($request);
    }
}
