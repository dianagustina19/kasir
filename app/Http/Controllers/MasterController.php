<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(){
        return view('index');
    }

    public function getPossiblePayments($amount)
    {
        $possiblePayments = [];
        $denominations = [100000, 50000, 20000, 10000, 5000, 2000, 1000, 500, 200, 100];
        $anotherpayment = [];

        $indexs = 0;
        foreach ($denominations as $key => $value) {
            if ($amount >= $value) {
                break;
            }
            $indexs++;
        }
  
        foreach ($denominations as $index => $denomination) {
            if ($index < count($denominations) - 1) {
                if($indexs != 0 ){
                    $nextDenomination = $denominations[$indexs - 1];
                    $sum = $denomination + $denominations[$index + 1];
                    if ($sum > $amount && $sum <= 100000 && $sum < $nextDenomination) {
                        $anotherpayment[] = $sum;
                    }
                }
            }
        }   
   
        foreach ($denominations as $denomination) {
            if ($denomination > $amount) {
                $possiblePayments[] = $denomination;
            }
        }

        if (in_array($amount, $denominations)) {
            $possiblePayments[] = $amount;
        }
    
        foreach ($denominations as $denomination1) {
            foreach ($denominations as $denomination2) {
                $sum = $denomination1 + $denomination2;
                if ($sum === $amount && !in_array($sum, $possiblePayments)) {
                    $possiblePayments[] = $sum;
                }
            }
        }

        if($possiblePayments){
                
            $possiblePayments = array_merge($possiblePayments, $anotherpayment);
            sort($possiblePayments);

            $possiblePayments = array_filter($possiblePayments, function($payment) use ($amount) {
                return $payment !== $amount;
            });
        }
      
        return $possiblePayments;
    }

}
