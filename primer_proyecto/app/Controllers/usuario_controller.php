<?php
namespace App\Controllers;

use App\Models\usuario_model;
use CodeIgniter\Controller;

class usuario_controller extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function create()
    {
        $data['titulo'] = 'registro';
        echo view('front/head_view', $data);
        echo view('front/navbar_view');
        echo view('back/usuario/registro');
        echo view('front/footer_view');
    }

    public function formValidation()
    {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario' => 'required|min_length[3]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[3]|max_length[10]'
        ]);

        if (!$input) {
            // Validación fallida, mostrar errores de validación
            $data['titulo'] = 'Fundacion patitas - Registrarse';
            echo view('front/head_view', $data);
            echo view('front/navbar_view');
            echo view('back/usuario/registro', ['validation' => $this->validator]);
            echo view('front/footer_view');
        } else {
            // Validación exitosa, verificar si el usuario ya existe en la base de datos
            $formModel = new usuario_model();
            $existingUser = $formModel->where('email', $this->request->getVar('email'))->first();

            if ($existingUser) {
                // El usuario ya existe, mostrar un mensaje de error
                $data['titulo'] = 'Fundacion patitas - Registrarse';
                echo view('front/head_view', $data);
                echo view('front/navbar_view');
                echo view('back/usuario/registro', ['emailError' => 'El correo electrónico ya está registrado']);
                echo view('front/footer_view');
            } else {
                // El usuario no existe, guárdalo en la base de datos
                $formModel->save([
                    'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'usuario' => $this->request->getVar('usuario'),
                    'email' => $this->request->getVar('email'),
                    'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
                ]);

                session()->setFlashdata('success', 'Usuario registrado con éxito');
                return redirect()->to(base_url('/registro'));
            }
        }
    }
}