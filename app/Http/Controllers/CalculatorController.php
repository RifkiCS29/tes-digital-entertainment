<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;

class CalculatorController extends Controller
{
    public function index()
    {
        $results = Result::latest()->get();
        return view('calculator')->with('results', $results);
    }
    
    public function calculate(Request $request)
    {
        $request->validate([
            'first_number' => 'required',
            'operator' => 'required',
            'second_number' => 'required'
        ]);

        $first_number = $request->get('first_number');
        $operator = $request->get('operator');
        $second_number = $request->get('second_number');
        $result = $this->calculateResult($first_number, $operator, $second_number);

        $calculate = new Result([
            'first_number' => $first_number,
            'second_number' => $second_number,
            'operator' => $operator,
            'result' => $result

        ]);

        $calculate->save();
        return redirect()->route('calc')->with('info', 'Answer: ' . $result);
    }

    private function calculateResult($first_number, $operator, $second_number)
    {
        if ($operator == "plus") {
            $result = $first_number + $second_number;
        } elseif ($operator == "minus") {
            $result = $first_number - $second_number;
        } elseif ($operator == "multiply") {
            $result = $first_number * $second_number;
        } elseif ($operator == "divide") {
            $result = $first_number / $second_number;
        } else {
            $result = 0;
        }

        return $result;
    }
}
