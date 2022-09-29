<?php

namespace App\Http\Controllers;

use App\Consignment;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $consignments = Consignment::all();
        return view('home', compact('consignments'));
    }

    public function pdfConverter(Request $request)
    {
        if (Auth::check() && User::where('email', decrypt($request->user_email))->first()) {
            $head_arr = $request->head_array;
            $records = array();
            foreach ($request->input_array as $key => $values) {
                for ($i = 0; $i < sizeof($head_arr); $i++) {
                    $records[$key][$head_arr[$i]] = $values[$i];
                }
            }
            $data = ['records' => $records];
            $pdf = Pdf::loadView('pdf.pdf_view', $data);
            $file_name = time() . 'invoice.pdf';
            Storage::put('public/pdf/' . $file_name, $pdf->output());

            return response()->json(['file_name' => $file_name], 200);
        } else {
            return response()->json(['error' => 'You are not logged in'], 401);
        }
    }

}
