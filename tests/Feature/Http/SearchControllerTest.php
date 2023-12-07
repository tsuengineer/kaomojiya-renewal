<?php

namespace Tests\Feature\Http;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_検索結果を表示()
    {
        $this->get(route('search.index'))
            ->assertOk()
            ->assertViewIs('search.index')
            ->assertViewHasAll(['facemarks', 'searchData']);
    }
}
