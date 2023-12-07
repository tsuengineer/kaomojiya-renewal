<?php

namespace Tests\Feature\Usecases\Search;

use App\Models\Facemark;
use App\Models\Tag;
use App\Models\User;
use App\Usecases\Search\IndexAction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class IndexActionTest extends TestCase
{
    use RefreshDatabase;

    private IndexAction $action;
    /**
     * @var Collection|Model|mixed
     */
    private array $facemarks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = new IndexAction();

        $olderTime = Carbon::now()->subMinutes(30);

        $user = User::factory()->create();

        // 投稿を10件作成する
        // 投稿時間は30分前から1分ずつずらす, タグを設定する
        for ($i = 0; $i < 10; $i++) {
            $this->facemarks[] = Facemark::factory()->create([
                'user_id' => $user->id,
                'data' => ($i % 2 === 0) ? "(^^) Even: $i" : "(^^) Odd: $i",
                'created_at' => $olderTime->addMinutes(),
            ]);
        }
        $tag = Tag::factory()->create(['name' => 'test']);
        for ($i = 0; $i < 10; $i++) {
            $this->facemarks[$i]->tags()->attach($tag);
        }
    }

    /**
     * @test
     */
    public function キーワードで投稿を検索して最新順で取得()
    {
        $searchData = [
            'keyword' => 'Odd',
            'tag' => null,
            'order' => 'desc',
        ];

        $result = ($this->action)($searchData);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);

        $this->assertEquals('(^^) Odd: 9', $result[0]->data); // 最新の投稿が先頭に来るはず
        $this->assertEquals('(^^) Odd: 1', $result[4]->data); // 最古の投稿が最後に来るはず
    }

    /**
     * @test
     */
    public function タグで投稿を検索して最新順で取得()
    {
        $searchData = [
            'keyword' => null,
            'tag' => 'test',
            'order' => 'desc',
        ];

        $result = ($this->action)($searchData);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount(10, $result); // 10件の投稿がタグで検索されるはず

        $this->assertEquals('(^^) Odd: 9', $result[0]->data); // 最新の投稿が先頭に来るはず
        $this->assertEquals('(^^) Even: 0', $result[9]->data); // 最古の投稿が最後に来るはず
    }
}
