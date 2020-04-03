<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sample;
use Illuminate\Support\Facades\DB;
use App\Classes\GlobalClass;

class DatabaseController extends Controller
{
    //
    public function insertData(){
        echo 'Inserting...';
        $arr = array();
        for($i = 0; $i < 1000; $i++){
            $rand = rand();
            $age = rand(10, 100);
            $sample = new Sample;
            $sample->name = "name "."$i";
            $sample->random_number = strval($rand);
            $sample->age = strval($age);
            $sample->save();
            array_push($arr, $sample->id);  
        }
        dd($arr);
        // return redirect()->to('/home');
    }

    public function paginate(){
        $pagination = DB::table('sample')->paginate(10);

        dd($pagination);
        
    }

    public function testClass(){
        // Vat Type [ Subject to 12%, Exempt, Rated, Non-VAT ]
        $global = new GlobalClass();
        $arr = [
            'firstRow' => [
                'amount' => 100000.00,
                'discount' => 0,
                'inclusive' => true, 
                'vatType' => 'subject'
            ],
            'secondRow' => [
                'amount' => 200000.00,
                'discount' => 0,
                'inclusive' => true, 
                'vatType' => 'exempt'
            ]
        ];
        $test = $global->compute($arr);
        $total = $global->total($test);
        echo $total;
        dd($test);
    }
}
