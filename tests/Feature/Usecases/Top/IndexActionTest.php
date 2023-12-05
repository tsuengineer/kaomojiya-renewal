<?php

namespace Tests\Feature\Usecases\Top;

use App\Models\Facemark;
use App\Models\User;
use App\Usecases\Top\IndexAction;
use Tests\TestCase;

class IndexActionTest extends TestCase
{
    private IndexAction $action;
    private $facemarks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = new IndexAction();

        User::factory(5)->create();
        Facemark::factory(100)->create();

        $this->facemarks = Facemark::latest()->get();
    }

    /**
     * @test
     */
    public function イラスト一覧を最新順で返却()
    {
        $result = ($this->action)();

        $this->assertEquals(
            $result['latestFacemarks']->pluck('id')->toArray(),
            $this->facemarks->take(20)->pluck('id')->toArray(),
        );
    }

    /**
     * @test
     */
    public function ランダムイラストに最新20件が含まれない()
    {
        $result = ($this->action)();

        $latestFacemarkIds = $result['latestFacemarks']->pluck('id')->toArray();
        $randomFacemarkIds = $result['randomFacemarks']->pluck('id')->toArray();

        foreach ($latestFacemarkIds as $latestFacemarkId) {
            $this->assertNotContains($latestFacemarkId, $randomFacemarkIds);
        }
    }
}
