<?php

namespace Tests\Feature;

use App\Mail\ContactMail;
use App\Models\Contact;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests empty contact form.
     *
     * @return void
     */
    public function testSubmitEmptyContactForm()
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
    public function testSubmitContactFormWithUnformattedPhone()
    {
        $data = Contact::factory()->create(['phone' => 'none']);

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('phone');
    }

    /**
     * Tests the sent contact form with invalid email field.
     *
     * @return void
     */
    public function testSubmitContactFormWithInvalidEmail()
    {
        $data = Contact::factory()->create(['email' => 'test']);

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('email');
    }

    /**
     * Tests the sent contact form with exceeded limit file size
     * in the attachement field.
     *
     * @return void
     */
    public function testSubmitContactFormExcedingFileSizeAttached()
    {
        $file = UploadedFile::fake()->create('test.pdf', 999999);

        $data = Contact::factory()->create(['attachment' => $file]);

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('attachment');
    }

    /**
     * Tests the sent contact form with file extension not allowed
     * in the attachement field.
     *
     * @return void
     */
    public function testSubmitContactWithInvalidFileExtension()
    {
        $file = UploadedFile::fake()->create('test.png');

        $data = Contact::factory()->create(['attachment' => $file]);

        $this->post('/store', $data->toArray())
            ->assertSessionHasErrors('attachment');
    }

    /**
    * Tests the sent contact form with no errors.
    *
    * @return void
    */
    public function testSubmitContactFormWithNoErrors()
    {
        Storage::fake('fakefs');
        Mail::fake();

        $file = UploadedFile::fake()->create('test.pdf');

        $data = Contact::factory()->create(['attachment' => $file]);

        $this->followingRedirects()
            ->post('/store', $data->toArray())
            ->assertSessionHasNoErrors()
            ->assertSee('Contato salvo com sucesso!');

        Mail::assertSent(ContactMail::class);
    }
}
