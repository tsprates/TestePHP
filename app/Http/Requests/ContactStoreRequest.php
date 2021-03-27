<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! preg_match("/^\(\d{2}\) \d{4,5}-\d{4}$/", $value)) {
                        $fail('O campo telefone é inválido (xx) xxxxx-xxxx.');
                    }
                }
            ],
            'message'    => 'required',
            'attachment' => 'required|file|mimes:pdf,doc,docx,odt,txt|max:500',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'       => 'O campo nome é obrigatório.',
            'email.required'      => 'O campo email é obrigatório.',
            'email.email'         => 'O campo email é inválido.',
            'phone.required'      => 'O campo telefone é obrigatório.',
            'message.required'    => 'O campo mensagem é obrigatório.',
            'attachment.required' => 'O campo anexo é obrigatório.',
            'attachment.mimes'    => 'O campo anexo deve PDF, DOC, DOCX, ODT ou TXT.',
            'attachment.file'     => 'O campo anexo deve PDF, DOC, DOCX, ODT ou TXT.',
            'attachment.max'      => 'O campo anexo deve conter o máximo de 500KB.',
        ];
    }
}
