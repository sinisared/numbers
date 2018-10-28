<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\MathApiController;

class MathApiControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetClassificationCorrectNumber()
    {
        $obj = new MathApiController();
        $result = $obj->getClassification(1);
        $this->assertEquals(['type' => 'deficient'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
    }
    public function testGetClassificationIncorrectNumber()
    {
        $obj = new MathApiController();
        $result = $obj->getClassification('qwewq');
        $this->assertArraySubset(['error' => 'Provided number is not a positive integer'],json_decode($result->getContent(), true));
        $this->assertEquals($result->getStatusCode(), 422);
    }

    public function testGetClassificationAbundantNumber()
    {
        $obj = new MathApiController();
        $result = $obj->getClassification(12);
        $this->assertEquals(['type'=>'abundant'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(18);
        $this->assertEquals(['type'=>'abundant'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(196);
        $this->assertEquals(['type'=>'abundant'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
    }


    public function testGetClassificationPerfectNumber()
    {
        $obj = new MathApiController();
        $result = $obj->getClassification(6);
        $this->assertEquals(['type'=>'perfect'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(28);
        $this->assertEquals(['type'=>'perfect'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(496);
        $this->assertEquals(['type'=>'perfect'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
    }

    public function testGetClassificationDeficientNumber()
    {
        $obj = new MathApiController();
        $result = $obj->getClassification(1);
        $this->assertEquals(['type'=>'deficient'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(3);
        $this->assertEquals(['type'=>'deficient'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
        $result = $obj->getClassification(4);
        $this->assertEquals(['type'=>'deficient'],json_decode($result->getContent(),true));
        $this->assertEquals($result->getStatusCode(), 200);
    }

}
