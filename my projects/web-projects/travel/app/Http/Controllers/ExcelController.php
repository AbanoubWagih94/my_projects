<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\SightSeeing;
use App\Travel;
use App\Terminal;
use App\TravelArea;
use App\TravelSightSeeing;
use Excel;
use Exception;

class ExcelController extends Controller 
{

    private function handleTravel($request, $data){
        $company = Company::where('id', $request->company_id)->first();
        $travel = $company->travels();
        $travels = [];

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['auto_number'] = $company->slogan.'_'.($travel->count()+$i);   
            array_push($travels, new Travel($data[$i]));
        }

        return $company->travels()->saveMany($travels);
    }

    private function handleTerminal($data, $travel){
        $terminals = [];
        for ($i=0; $i < 2; $i++) { 
            $data[$i]['type'] = $i;
            array_push($terminals, new Terminal($data[$i]));
        }

        $travel->terminals()->saveMany($terminals);
    }

    private function handleAreas($area_id, $data, $travel){
        $data[0]['area_id'] = $area_id;
        return $travel->travelAreas()->save(new TravelArea($data[0]));    
    }

    private function handleSightSeeings($data, $travelArea){
        $sightSeeings = [];
        for ($i=0; $i < count($data); $i++) { 
            $sightSeeing = SightSeeing::where('name', $data[$i]['name']);
            if($sightSeeing->count()){
                $data[$i]['sight_seeing_id'] = $sightSeeing->first()->id;
            }else{
                
                $this->handleError('No sightseeing name ' . $data[$i]['name']);
            }
            array_push($sightSeeings, new TravelSightSeeing($data[$i]));
        }
        $travelArea->sightSeeings()->saveMany($sightSeeings);
        
    }

    private function handleError($errors){
        
        throw new Exception($errors);
    }

    public function upload(Request $request ){
        $file = $request->file('file');
        if($file->extension() != 'xlsx'){
           $this->handleError('Invalid file type');
        }
        $path = $file->store('excel');
        $basePath = storage_path('app'.DIRECTORY_SEPARATOR);
        $results = null;

        Excel::load($basePath.$path, function($reader) use($request, &$results){
           DB::transaction(function () use($request, $reader, &$results) {
            $reader->formatDates(true, 'Y-m-d G:i');
            $data = $reader->toArray();
            // dd($data);
            $travels = $this->handleTravel($request, $data[0]);

            foreach ($travels as $travel) { 
                $this->handleTerminal($data[1], $travel);
                $travelArea = $this->handleAreas($request->area_id_1, $data[2], $travel);
                $this->handleSightSeeings($data[3], $travelArea);
                $travelArea = $this->handleAreas($request->area_id_2, $data[4], $travel);
                $this->handleSightSeeings($data[5], $travelArea);
            }

            $results = $travels;
           }, 5);
        });
        Storage::delete($path);

        return response()->json(formResponse(200, $results));
    } 
}
