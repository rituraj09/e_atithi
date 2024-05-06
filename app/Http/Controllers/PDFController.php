<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function index()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
          
        $pdf = PDF::loadView('pdf.testPdf', $data);
    
        return $pdf->download('tutsmake.pdf');
    }
}
