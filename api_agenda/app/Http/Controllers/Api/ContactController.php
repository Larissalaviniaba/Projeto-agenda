<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    
    public function index(){

        $contact = Contact::all();

        return $contact;
    }

    public function create(Request $request){

        // Define as regras de validação dos campos
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contacts,email',
            'number' => 'required|string|max:20|unique:contacts,number',
        ];

        // Define as mensagens de erro personalizadas
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres.',
            'email.unique' => 'Este email já existe.',
            'number.required' => 'O campo número é obrigatório.',
            'number.string' => 'O campo número deve ser uma string.',
            'number.max' => 'O campo número deve ter no máximo 20 caracteres.',
            'number.unique' => 'Este número já existe.',
        ];

        // Executa a validação dos dados da request
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verifica se houve erros na validação
        if ($validator->fails()) {
            return ['return' => 'Erro de validação', 'errors' => $validator->errors()];
        }

        try {
            $contact = New Contact();

            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->number = $request->number;

            // Image Upload
            if($request->hasFile('image') && $request->file('image')->isvalid()){

                $request_image = $request->image;

                $extension = $request_image->extension();

                $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $request_image->move(public_path('imgs/contacts'), $image_name);

                $contact->image = $image_name;

            }

            $contact->save();

            return ['return'=>'Contato salvo!'];

        } catch (\Exception $erro) {
            
            return ['return'=>'Erro', 'details'=>$erro];
        }
    }


    public function select($id){

        $contact = Contact::find($id);

        return $contact;
    }

    
    public function update(Request $request, $id){

        try {

            Contact::findOrFail($request->id)->update($request->all());

            if($request->hasFile('image') && $request->file('image')->isvalid()){


                $request_image = $request->image;

                $extension = $request_image->extension();

                $image_name = md5($request_image->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $request_image->move(public_path('imgs/contacts'), $image_name);

                $image = $image_name;


                Contact::findOrFail($request->id)->update([
                    'image' => $image
                ]);

            }
                
            return ['return'=> 'Contato atualizado!', 'data'=>$request->all()];

        } catch (\Exception $erro) {

            return ['return'=>'Erro', 'details'=>$erro];
        }
    }

    
    public function delete($id){
        
        try {
            
            $contact = Contact::find($id);

            $contact->delete();

            return ['return'=>'Contato excluido¹'];

        } catch (\Exception $erro) {
            return ['return'=>'Erro', 'details'=>$erro];
        }
    }
}
