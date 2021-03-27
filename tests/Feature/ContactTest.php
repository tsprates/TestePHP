<?php

namespace Tests\Feature;

use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests accessing index.
     *
     * @return void
     */
    public function testAccessingIndex()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /**
     * Tests empty contact form.
     *
     * @return void
     */
    public function testSendEmptyContactForm()
    {
        $response = $this->post('/store', []);

        $response->assertSessionHasErrors([
            'name', 'email', 'phone', 'message', 'attachment'
        ]);
    }

    /**
     * Tests the sent contact form with unformatted phone field.
     *
     * @return void
     */
    public function testSendContactFormWithUnformattedPhone()
    {
        $data = Contact::factory()->create();
        $data['phone'] = 'none';

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('phone');
    }

    /**
     * Tests the sent contact form with invalid email field.
     *
     * @return void
     */
    public function testSendContactFormWithInvalidEmail()
    {
        $data = Contact::factory()->create();
        $data['email'] = 'test';

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('email');
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

        $data = Contact::factory()->create();
        $data['attachment'] = $file;

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('attachment');
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

        $data = Contact::factory()->create();
        $data['attachment'] = $file;

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('attachment');
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

        $data = Contact::factory()->create();
        $data['attachment'] = $file;

        $this->followingRedirects()
            ->post('/store', $data->toArray())
            ->assertSessionHasNoErrors()
            ->assertSee('Contato salvo com sucesso!');
    }
}
