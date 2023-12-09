<?php

namespace Tests\Feature\Usecases\Profile;

use App\Models\Avatar;
use App\Models\User;
use App\Usecases\Profile\UpdateAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateActionTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $avatar = Avatar::factory()->create([
            'user_id' => $this->user->id,
            'path' => 'previous_avatar.jpg',
        ]);

        $this->user->setRelation('avatars', $avatar);

        Storage::fake('direct');
    }

    /**
     * @test
     */
    public function ユーザ情報を更新しアバター画像をアップロード()
    {
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $updateAction = new UpdateAction();

        $avatarFile = UploadedFile::fake()->image('avatar.jpg');

        $updateAction($this->user, $data, $avatarFile);

        $this->assertEquals('Updated Name', $this->user->name);
        $this->assertEquals('updated@example.com', $this->user->email);

        $directory = floor($this->user->id / 1000);
        $avatar = Avatar::where('user_id', $this->user->id)->first();
        $fileName = $avatar->path;
        $filePath = config('image.avatar_path') . '/' . $directory . '/' . $fileName;

        $this->assertTrue(Storage::disk('direct')->exists($filePath));
    }

    /**
     * @test
     */
    public function アバター画像を更新した場合、古い画像情報が削除されること()
    {
        $updateAction = new UpdateAction();

        $avatarFile = UploadedFile::fake()->image('avatar.jpg');

        $updateAction($this->user, [], $avatarFile);

        $this->assertCount(1, Avatar::where('user_id', $this->user->id)->get());
        $this->assertFalse(Storage::disk('direct')->exists($this->user->avatars->path));
    }
}
