<?php

namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Guide;
use App\Models\Route;
use App\Models\User;
use Illuminate\Http\Request;

    class PDFController extends Controller
    {
        public function generatePDF()
        {
        $data = [
            'title' =>'Welcome to ThisIsMyCity.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('myPDF',$data);

        return $pdf->download('myPDF.pdf');

        }

        protected function generatePDF_report(){
           return report_admin();
        }
    }
