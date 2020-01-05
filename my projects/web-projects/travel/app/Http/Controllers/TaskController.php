<?php

namespace App\Http\Controllers;

use Nexmo;
use Illuminate\Http\Request;
use App\Task;
use App\Notification;
use Validator;

class TaskController extends Controller
{
    private $request = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Validate the request have valid Task data
     *
     * @param mixed $data
     * @return Validator
     */
    
    private function validateRequest($data)
    {
        $validation_rules = [
           'user_id' => 'required',
           'travel_id' => 'required',
           'time' => 'required',
           'date' => 'required',
           'details' => 'required',
           'priority' => 'required'
        ];
        
        return Validator::make($data, $validation_rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('date', 'desc');
        if ($this->request->has('user_id')) {
            $tasks = $tasks->where('user_id', $this->request->user_id);
        }
        if ($this->request->has('travel_id')) {
            $tasks = $tasks->where('travel_id', $this->request->travel_id);
        }

        return response()->json(formResponse(200, $tasks->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if ($this->request->user->type > 3) {
            return response()->json(formResponse(401, "Unauthorized"));
        }

        $data = $this->request->all();
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $task = Task::create($data);
            $this->addNotification("You have a new Task", $data['user_id'], 'task/'.$task->id);
            return response()->json(formResponse(200, $task));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->first();

        return response()->json(formResponse(200, $task));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if ($this->request->user->type > 3) {
            return response()->json(formResponse(401, "Unauthorized"));
        }

        $data = $this->request->all();
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $task = Task::where('id', $id)->update($data);
            return response()->json(formResponse(200, $task));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->request->user->type > 3) {
            return response()->json(formResponse(401, "Unauthorized"));
        }

        $task = Task::destroy($id);
        return response()->json(formResponse(200, $task));
    }

    /**
     * Upgrade thr task status & send notifications.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accomplish($id)
    {
        
        $task = Task::where('id', $id)->first();
        if ($this->request->user->id != $task->user_id) {
            return response()->json(formResponse(401, "Unauthorized"));
        }

        $task->status = 1;
        $task->save();

        $area_managers = $task->user()->first()->area()->first()->users()->where('type', 3)->get();
        foreach ($area_managers as $area_manager) {
            $this->addNotification("Task ".$task->details." accomplished", $area_manager->id, "task/".$task->id);
        }

        $next_task = Task::where('travel_id', $task->travel_id)
        ->where('priority', '>', $task->priority)->where('status', 0)
        ->first();
        if ($next_task) {
            $next_task_user = $next_task->user;
            $next_task_message =
            "your next task is " . $next_task->details .
            " at " . $next_task->time . " , ".$next_task->date;

            $this->addNotification($next_task_message, $next_task_user->id, 'task/'.$next_task->id);
        }

        return response()->json(formResponse(200, ""));
    }

    private function addNotification($details, $user_id, $end_point)
    {
        Notification::create(['details' => $details, 'user_id' => $user_id, 'end_point' => $end_point]);
    }
}
