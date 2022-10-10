<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $name = 'Yongki';
        $score = 78;
        if($score >= 90 && $score <= 100) {
            $grade = 'A';
        } elseif($score >= 80 && $score <= 89) {
            $grade = 'B';
        } elseif($score >= 70 && $score <= 79) {
            $grade = 'C';
        } elseif($score >= 60 && $score <= 69){
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        
        $result = "$name get grade $grade";
        return $result;
    }

    public function ganjilGenap()
    {
        $numbers = [11, 22, 33, 44, 55, 66, 77, 88, 99, 100];
        $result = [
            'odd_numbers' => [],
            'even_numbers' => [],
        ];
        foreach($numbers as $number) {
            if( ($number % 2) == 0) {
                array_push($result['even_numbers'], $number);
            } else {
                array_push($result['odd_numbers'], $number);
            }
        }

        return $result;
    }

    public function perulanganDuaKali()
    {
        $star = 5;
        for($a = $star; $a > 0; $a--){
            for($i = 1; $i <= $a; $i++){
                echo "&nbsp";
            }
            for($a1 = $star; $a1 >= $a; $a1--){
                echo"*";
            }
            echo"<br>";
        }
    }
}
