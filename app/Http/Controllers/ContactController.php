<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactStoreRequest;

class ContactController extends Controller
{
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
            'ip'      => $request->ip()
        ];
        
        // $this->sendContactMail($contact);

        // saves the uploaded file (attachment)
        $contact['attachment'] = basename($request->attachment->store('public/attachments'));

        Contact::create($contact);

        $request->session()->flash('status', 'Contato salvo com sucesso!');

        return redirect()->back();
    }

    /**
     * Sends the saved contact mail.
     * 
     * @param array $contact
     */
    private function sendContactMail(array $contact) 
    {
        Mail::to('tsprates@hotmail.com')
            ->send(new ContactMail($contact));
    }
}
