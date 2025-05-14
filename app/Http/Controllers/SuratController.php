<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    // Di SuratController.php
    public function cetakSurat($id, $template)
        {
            $surat = Surat::with('kategori')->findOrFail($id);
            
            $view = 'surat.templates.' . $template;
            
            if (!view()->exists($view)) {
                abort(404, "Template surat '$template' tidak ditemukan");
            }
            
            return view($view, compact('surat'));
        }
}