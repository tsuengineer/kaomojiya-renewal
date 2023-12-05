<?php

namespace Tests\Feature\Http;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function edit_プロフィール編集フォームを表示()
    {
        $this->actingAs($this->user)
            ->get(route('profile.edit'))
            ->assertOk()
            ->assertViewIs('profile.edit')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function edit_ログインしていない場合にログインページへリダイレクト()
    {
        $this->get(route('profile.edit'))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function update_プロフィール情報を更新()
    {
        $this->actingAs($this->user)
            ->patch(route('profile.update'), [
                'name' => '新しい名前',
                'email' => 'new@example.com',
            ])
            ->assertRedirect(route('profile.edit'));
    }

    /**
     * @test
     */
    public function update_ログインしていない場合にログインページへリダイレクト()
    {
        $this->patch(route('profile.update'), [
            'name' => '新しい名前',
            'email' => 'new@example.com',
        ])->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function destroy_ユーザーアカウントを削除()
    {
        $this->actingAs($this->user)
            ->delete(route('profile.destroy'))
            ->assertRedirect('/');
    }

    /**
     * @test
     */
    public function destroy_ログインしていない場合にログインページへリダイレクト()
    {
        $this->patch(route('profile.update'))
            ->assertRedirect(route('login'));
    }
}
