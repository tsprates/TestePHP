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

    /**
     * Fake data for the tests.
     *
     * @return array
     */
    private function getTestData()
    {
        return [
            'name'    => 'Test User',
            'phone'   => '(11) 11111-1111',
            'email'   => 'test@test.com',
            'message' => 'Test message',
        ];
    }

    /**
     * Tests accessing index.
     *
     * @return void
     */
    public function testAccessingIndex()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
    }
    
    /**
     * Tests empty contact form.
     *
     * @return void
     */
    public function testSendEmptyContactForm()
    {
        $response = $this->post('/store', []);
        
        $response->assertSessionHasErrors(['name', 'email', 'phone', 'message', 'attachment']);
    }
    
    /**
     * Tests the sent contact form with unformatted phone field.
     *
     * @return void
     */
    public function testSendContactFormWithUnformattedPhone()
    {
        $data = $this->getTestData();
        $data['phone'] = 'none';

        $response = $this->post('/store', $data);
        
        $response->assertSessionHasErrors('phone');
    }
    
    /**
     * Tests the sent contact form with invalid email field.
     *
     * @return void
     */
    public function testSendContactFormWithInvalidEmail()
    {
        $data = $this->getTestData();
        $data['email'] = 'test';

        $response = $this->post('/store', $data);
        
        $response->assertSessionHasErrors('email');
    }

    /**
     * Tests the sent contact form with exceeded limit file size
     * in the attachement field.
     *
     * @return void
     */
    public function testSendContactFormExcedingFileSizeAttached()
    {
        $file = UploadedFile::fake()->create('test.pdf', 999999);
        
        $data = $this->getTestData();
        $data['attachment'] = $file;

        $response = $this->post('/store', $data);

        $response->assertSessionHasErrors('attachment');
    }
    
    /**
     * Tests the sent contact form with file extension not allowed
     * in the attachement field.
     *
     * @return void
     */
    public function testSendContactWithInvalidFileExtension()
    {
        $file = UploadedFile::fake()->create('test.png');
        
        $data = $this->getTestData();
        $data['attachment'] = $file;

        $response = $this->post('/store', $data);

        $response->assertSessionHasErrors('attachment');
    }
    
     /**
     * Tests the sent contact form with no errors.
     *
     * @return void
     */
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
