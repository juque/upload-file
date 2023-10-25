<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testShowIndex(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testUploadStored(): void
    {
        Storage::fake('attachments');

        $file = UploadedFile::fake()->create('photo.jpg', 100);

        $response = $this->post('/', [
            'attachment' => $file,
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('message', 'File Successfully uploaded');

        Storage::disk('attachments')->assertExists($file->hashName());
    }


    public function testStoreAcceptsJpgFile()
    {
        Storage::fake('attachments');

        $jpgFile = UploadedFile::fake()->create('document.jpg', 100);

        $response = $this->post('/', [
            'attachment' => $jpgFile,
        ]);

        $response->assertStatus(302)
                 ->assertSessionHas('message', 'File Successfully uploaded');

        Storage::disk('attachments')->assertExists($jpgFile->hashName());
    }

    public function testStoreAcceptsPngFile()
    {
        Storage::fake('local');

        $pngFile = UploadedFile::fake()->create('document.png', 100);

        $response = $this->post('/', [
            'attachment' => $pngFile,
        ]);

        $response->assertStatus(302)
                 ->assertSessionHas('message', 'File Successfully uploaded');

        Storage::disk('attachments')->assertExists($pngFile->hashName());
    }

    public function testStoreRejectsTxtFile()
    {
        Storage::fake('local');

        $txtFile = UploadedFile::fake()->create('document.txt', 100);

        $response = $this->post('/', [
            'attachment' => $txtFile,
        ]);

        $response->assertSessionHasErrors('attachment');
    }

}
