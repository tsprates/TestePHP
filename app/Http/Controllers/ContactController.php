<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactStoreRequest;

class ContactController extends Controller
{
    public function index() 
    { 
        return view('form-contact');
    }
    
    /**
     * Stores the contact data.
     *
     * @param  ContactStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $data    = $request->validated();
        $contact = [
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'message' => $data['message'],
            'ip'      => $request->ip(),
            'attachment' => 'storage/attachments/' . basename($request->attachment->store('public/attachments')),
        ];
        
        $this->sendContactMail($contact);

        Contact::create($contact);

        $request->session()->flash('status', 'Contato salvo com sucesso!');

        return redirect()->back();
    }

    /**
     * Sends the mail about the saved contact.
     * 
     * @param array $contact
     */
    private function sendContactMail(array $contact) 
    {
        try {
            Mail::to($contact['email'])
                ->send(new ContactMail($contact));
        } catch (\Exception $e) {
            Log::error(sprintf("Erro ao enviar email: %s.", $e->getMessage()));
        } catch (\Error $e) {
            Log::error(sprintf("Erro ao enviar email: %s.", $e->getMessage()));
        }
    }

    public function list()
    {
        return view(
            'list-contact', 
            ['contacts' => Contact::all()]
        );
    }
}
