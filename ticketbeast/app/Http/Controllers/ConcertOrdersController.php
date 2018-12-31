<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Billing\PaymentGateway;

class ConcertOrdersController extends Controller
{
    private $paymentGateway;

    public function __contstruct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }  

    public function store()
    {
        $this->paymentGateway->charge($amount, $token);
        return response()->json([], 201);
    }
}