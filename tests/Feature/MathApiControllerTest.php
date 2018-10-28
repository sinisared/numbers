<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MathApiControllerTest extends TestCase
{
    /**
     * Testing random abundant numbers.
     *
     * @return void
     */
    public function testGetClassificationAbundantNumber()
    {
        $resp = $this->get('/api/classify/12');
        $resp->assertJson(['type'=>'abundant']);
        $resp = $this->get('/api/classify/18');
        $resp->assertJson(['type'=>'abundant']);
        $resp = $this->get('/api/classify/196');
        $resp->assertJson(['type'=>'abundant']);
    }

    /**
     * Testing perfect numbers
     */
    public function testGetClassificationPerfectNumber()
    {
        $resp = $this->get('/api/classify/6');
        $resp->assertJson(['type'=>'perfect']);
        $resp->assertStatus(200);
        $resp = $this->get('/api/classify/28');
        $resp->assertJson(['type'=>'perfect']);
        $resp->assertStatus(200);
        $resp = $this->get('/api/classify/496');
        $resp->assertJson(['type'=>'perfect']);
        $resp->assertStatus(200);
        $resp = $this->get('/api/classify/33550336');
        $resp->assertJson(['type'=>'perfect']);
        $resp->assertStatus(200);
    }

    /**
     * testing deficient numbers
     */
    public function testGetClassificationDeficientNumber()
    {
        $resp = $this->get('/api/classify/1');
        $resp->assertJson(['type'=>'deficient']);
        $resp->assertStatus(200);
        $resp = $this->get('/api/classify/31');
        $resp->assertJson(['type'=>'deficient']);
        $resp->assertStatus(200);
        $resp = $this->get('/api/classify/50');
        $resp->assertJson(['type'=>'deficient']);
        $resp->assertStatus(200);
    }

    /**
     * testing float/decimal numbers
     */
    public function testGetClassificationFloatNumber()
    {
        $resp = $this->get('/api/classify/6.3432423');
        $resp->assertJson(['error'=>'Provided number is not a positive integer']);
        $resp->assertStatus(422);
        $resp = $this->get('/api/classify/0.234342545234');
        $resp->assertJson(['error'=>'Provided number is not a positive integer']);
        $resp->assertStatus(422);
    }

    /**
     * testing if string will catch error
     */
    public function testGetClassificationString()
    {
        $resp = $this->get('/api/classify/weqwfas');
        $resp->assertJson(['error'=>'Provided number is not a positive integer']);
        $resp->assertStatus(422);
        $resp = $this->get('/api/classify/wqeqwdwd');
        $resp->assertJson(['error'=>'Provided number is not a positive integer']);
        $resp->assertStatus(422);
    }
}
