<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function export()
    {
        $html = view('pdf.header')->render();

        User::select('name','email','created_at')
            ->chunk(200, function ($users) use (&$html) {
                $html .= view('users_chunk', compact('users'))->render();
            });

        $html .= view('pdf.footer')->render();

        $pdf = Pdf::loadHTML($html)
                  ->setPaper('a4','landscape');

        return $pdf->download('users.pdf');
    }
}
