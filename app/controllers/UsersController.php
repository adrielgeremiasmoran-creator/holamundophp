<?php

class UsersController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public function index(): void
    {
        $users = $this->user->all();
        $this->view('users/index', ['users' => $users, 'title' => 'Usuarios']);
    }

    public function create(): void
    {
        $this->view('users/create', ['title' => 'Crear Usuario']);
    }

    public function store(): void
    {
        $name = $this->input('name');
        $email = $this->input('email');
        $password = $this->input('password');
        $errors = [];

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
        if (empty($password) || strlen($password) < 6) $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
        if ($this->user->emailExists($email)) $errors[] = 'Este email ya está registrado.';

        if (!empty($errors)) {
            $_SESSION['flash']['errors'] = $errors;
            $this->redirect('/users/create');
        }

        $this->user->create(['name' => $name, 'email' => $email, 'password' => $password]);
        $_SESSION['flash']['success'] = 'Usuario creado correctamente.';
        $this->redirect('/users');
    }

    public function show($id = null): void
    {
        // No usado
    }

    public function edit($id = null): void
    {
        $user = $this->user->find((int) $id);

        if (!$user) {
            $_SESSION['flash']['errors'] = ['Usuario no encontrado.'];
            $this->redirect('/users');
        }

        $this->view('users/edit', ['user' => $user, 'title' => 'Editar Usuario']);
    }

    public function update($id = null): void
    {
        $id = (int) $id;
        $name = $this->input('name');
        $email = $this->input('email');
        $password = $this->input('password');
        $errors = [];

        if (empty($name)) $errors[] = 'El nombre es obligatorio.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
        if (!empty($password) && strlen($password) < 6) $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
        if ($this->user->emailExists($email, $id)) $errors[] = 'Este email ya está registrado.';

        if (!empty($errors)) {
            $_SESSION['flash']['errors'] = $errors;
            $this->redirect("/users/edit/$id");
        }

        $data = ['name' => $name, 'email' => $email];
        if (!empty($password)) {
            $data['password'] = $password;
        }

        $this->user->update($id, $data);
        $_SESSION['flash']['success'] = 'Usuario actualizado correctamente.';
        $this->redirect('/users');
    }

    public function destroy($id = null): void
    {
        $this->user->delete((int) $id);
        $_SESSION['flash']['success'] = 'Usuario eliminado correctamente.';
        $this->redirect('/users');
    }
}