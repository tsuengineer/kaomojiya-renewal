<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_トップページを表示()
    {
        $this->get(route('top.index'))
            ->assertOk()
            ->assertViewIs('top.index');
    }
}
