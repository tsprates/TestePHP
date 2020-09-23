<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    private function getTestData()
    {
        return [
            'name'    => 'Test User',
            'phone'   => '(11) 11111-1111',
            'email'   => 'test@test.com',
            'message' => 'Test message',
        ];
    }

    public function testAccessingIndex()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
    }
    
    public function testSendEmptyContactForm()
    {
        $response = $this->post('/store', []);
        
        $response->assertSessionHasErrors(
            [
                'name', 'email', 'phone', 'message', 'attachment'
            ]
        );
    }
    
    public function testSendContactFormWithUnformattedPhone()
    {
        $data = $this->getTestData();
        $data['phone'] = 'none';

        $response = $this->post('/store', $data);
        
        $response->assertSessionHasErrors(
            [
                'phone'
            ]
        );
    }
    
    public function testSendContactFormExcedingFileSize()
    {
        $file = UploadedFile::fake()->create('test.pdf', 999999);
        
        $data = $this->getTestData();
        $data['attachment'] = $file;

        $response = $this->post('/store', $data);

        $response->assertSessionHasErrors('attachment');
    }
    
    public function testSendContactWithInvalidFileExtension()
    {
        $file = UploadedFile::fake()->create('test.png');

        $data = $this->getTestData();
        $data['attachment'] = $file;

        $response = $this->post('/store', $data);

        $response->assertSessionHasErrors('attachment');
    }
    
    public function testSendContactFormWithNoErrors()
    {
        Storage::fake('fakefs');

        $file = UploadedFile::fake()->create('test.pdf');

        $data = $this->getTestData();
        $data['attachment'] = $file;

        $response = $this->post('/store', $data);

        $response->assertSessionHasNoErrors();
        
        $this->assertDatabaseCount('contacts', 1);
    }
}
