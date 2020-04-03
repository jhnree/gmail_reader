<?php

namespace App\Classes;

Class GlobalClass {

    public function compute($array){
        $computeData = [];
        foreach ($array as $key => $value) {
            
            switch ($value['vatType']) {
                case 'exempt':
                    $computeData[$key]['vatExemptSales'] = $this->vatExemptSales($value['amount']);
                    $vatRate = 0;
                    break;
                case 'rated':
                    $computeData[$key]['zeroRatedSales'] = $this->vatExemptSales($value['amount']);
                    $vatRate = 0;
                    break;
                case 'non-vat':
                    $computeData[$key]['nonVat'] = $this->vatExemptSales($value['amount']);
                    $vatRate = 0;
                    break;
                default:
                    $computeData[$key]['vatableSales'] = $this->vatableSales($value['amount'], $value['inclusive']);
                    $vatRate = 0.12;
                    break;
            }
    
            $discounted = $this->discount($value['amount'], $value['discount']);
    
            $computeData[$key]['vatAmount'] = $value['vatType'] == 'subject' ? $this->vatAmount($computeData[$key]['vatableSales'], $discounted, $vatRate) : 0.0;
            $computeData[$key]['discounted'] = $discounted;
        }
        return $computeData;
    }

    public function total($subTotal){
        $total = 0;
        foreach ($subTotal as $key => $rowCount) {
            foreach ($rowCount as $rowValue) {
                $total += $rowValue;
            }
        }
        return $total;
    }

    public function vatableSales($amount, $inclusive = true){
        // vatable = amount/1.12
        return $inclusive ? $amount/1.12 : $amount;
    }

    public function vatExemptSales($amount){
        // VAT Exempt = amount
        return $amount;
    }

    public function zeroRatedSales($amount){
        // Zero-Rated Sales = amount
        return $amount;
    }

    public function nonVat($amount){
        // Non-VAT = amount
        return $amount;
    }

    public function vatAmount($vatable, $discount, $vatRate){
        // VAT Amount = (vatable - discount) * vat rate
        return ($vatable - $discount) * $vatRate;
    }

    public function discount($amount, $discount, $inclusive = true){
        // If inclusive is true the computation is (amount * discount) / 1.12
        // else amount * discount
        return $inclusive ? ($amount * ($discount/100))/1.12 : $amount * $discount;
    }

    public function netAmount($amount, $discount){
        return $discount > 0 ? $amount - ($amount * ($discount/100)) : $amount;
    }
}