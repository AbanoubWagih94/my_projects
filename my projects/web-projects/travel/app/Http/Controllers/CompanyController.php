<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Company;
use App\User;

class CompanyController extends Controller
{

    /**
     * Validate the request have valid company data
     *
     * @param mixed $data
     * @return Validator
     */
    
    private function validateRequest($data)
    {
        return Validator::make($data, [
           'name' => 'required|min:5|max:20',
           'email' => 'required|email|min:10|max:50',
           'phones' => 'required|min:11|max:255',
           'slogan' => 'required'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(formResponse(200, Company::paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slogan'] = $data['name'];
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $company = null;
            DB::transaction(function () use ($data, &$company) {
                $company = Company::create($data);
                $user = [
                    'name' => preg_replace('/ /', '_', $company->name),
                    'password' => $company->email,
                    'email' => $company->email,
                    'phone' => explode(',', $company->phones)[0],
                    'type' => "5",
                ];
                $company->users()->create($user);
            });
            
            return response()->json(formResponse(200, $company));
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
        return response()->json(formResponse(200, Company::where('id', $id)->first()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slogan'] = $data['name'];
        $validator = $this->validateRequest($data);

        if ($validator->fails()) {
            return response()->json(formResponse(400, $validator->errors()));
        } else {
            $company = Company::where('id', $id)->first()->update($data);
            return response()->json(formResponse(200, $company));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::transaction(function () use ($id) {
            $company = Company::destroy($id);
            User::where('company_id', $id)->delete();    
        });
            
        return response()->json(formResponse(200, "true"));
    }
}
