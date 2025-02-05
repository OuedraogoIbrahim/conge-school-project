<?php

namespace App\Http\Controllers;

use App\Models\DemandeConge;
use Illuminate\Http\Request;

class DemandeValidationController extends Controller
{
    //

    public function accepter(DemandeConge $demande)
    {
        dd('Accepter');
    }
    public function refuser(DemandeConge $demande)
    {
        dd('Refuser');
    }
}
