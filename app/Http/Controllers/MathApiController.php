<?php

namespace App\Http\Controllers;

use App\Exceptions\NotIntegerException;

class MathApiController extends Controller
{

    private $sum;
    private $integer;

    /**
     * @param $integer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getClassification($integer)
    {
        try {
            $this->setInteger($integer);
            $this->getSum();
            if ($this->isPerfect()) {
                return $this->respond('perfect');
            }
            if ($this->isAbundant()) {
                return $this->respond('abundant');
            }
            if ($this->isDeficient()) {
                return $this->respond('deficient');
            }
        } catch (NotIntegerException $e) {
            return response(['error' => 'Provided number is not a positive integer'], 422);
        }
    }

    /**
     * check input parameter and set $integer value
     * @param $integer
     * @throws NotIntegerException
     */
    private function setInteger($integer)
    {
        if (!is_numeric($integer) || (int)$integer != $integer || (int) $integer < 0) {
            throw new NotIntegerException();
        }
        $this->integer = (int) $integer;
    }

    /**
     * @return bool
     */
    private function isPerfect()
    {
        return ($this->sum == $this->integer);
    }

    /**
     * @return bool
     */
    private function isAbundant()
    {
        return ($this->sum > $this->integer);
    }

    /**
     * @return bool
     */
    private function isDeficient()
    {
        return ($this->sum < $this->integer);
    }

    /**
     * @param $answer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function respond($answer)
    {
        return response(['type' => $answer], 200);
    }

    /**
     * calculate sum for comparison
     */
    private function getSum()
    {
        $sum = 0;
        for ($i = 1; $i <= sqrt($this->integer); $i++) {
            if ($this->integer % $i == 0) {
                if ($this->integer / $i == $i) {
                    $sum = $sum + $i;
                } else {
                    $sum = $sum + $i;
                    $sum = $sum + ($this->integer / $i);
                }
            }
        }
        $this->sum = $sum - $this->integer;
    }
}
