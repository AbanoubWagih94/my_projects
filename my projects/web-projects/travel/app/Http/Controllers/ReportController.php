<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Validator;
use App\User;

class ReportController extends Controller
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
           'details' => 'required',
           'user_id' => 'required',
           'travel_id' => 'required',
           
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
        $reports = Report::orderBy('date', 'desc');
        return response()->json(formResponse(200, $reports->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $data = $this->request->all();
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $data['date'] = date('Y-m-j');
            $data['time'] = date('G:i:s');
            $report = Report::create($data);
             $users = User::where('type', '=', 4)->get();
          /*  foreach ($users as $user) {
                $this->addNotification('New report is added', $user->id, 'report/'.$report->id);
            }*/
            return response()->json(formResponse(200, $report));
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
        $report = Report::where('id', $id)->first();

        return response()->json(formResponse(200, $report));
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

        $data = $this->request->all();
        $validator = $this->validateRequest($data, false);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $report = Report::where('id', $id)->update($data);
            return response()->json(formResponse(200, $report));
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
        $report = Report::destroy($id);
        return response()->json(formResponse(200, $report));
    }

    /**
     * Upgrade thr report status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accomplish($id)
    {
        
        $report = Report::where('id', $id)->first();
        if($report->status == 0)
        $report->status = 1;
        else
        $report->status = 2;
        $report->save();

        return response()->json(formResponse(200, $report));
    }

    private function addNotification($message, $to, $end_point)
    {
        echo $message.'<br>';
        echo $to.'<br>';
        echo $end_point.'<br>';
    }
}
