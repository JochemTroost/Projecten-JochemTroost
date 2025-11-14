<?php
namespace App\Controllers;

use App\Models\Employee;
use InvalidArgumentException;
use Smarty\Smarty;

class EmployeeController
{
    public function __construct(private Smarty $view) {}

    private function flash(?string $ok = null, ?string $err = null): void
    {
        if ($ok) $_SESSION['flash_ok'] = $ok;
        if ($err) $_SESSION['flash_err'] = $err;
    }

    public function index(): void
    {
        $employees = Employee::all();
        $flash_ok  = $_SESSION['flash_ok']  ?? null;
        $flash_err = $_SESSION['flash_err'] ?? null;
        unset($_SESSION['flash_ok'], $_SESSION['flash_err']);

        $this->view->assign('employees', $employees);
        $this->view->assign('flash_ok', $flash_ok);
        $this->view->assign('flash_err', $flash_err);
        $this->view->display('employees/index.tpl');
    }

    public function create(array $old = [], array $errors = []): void
    {
        $this->view->assign('action', 'store');
        $this->view->assign('old', $old);
        $this->view->assign('errors', $errors);
        $this->view->display('employees/form.tpl');
    }

    public function store(array $post): void
    {
        try {
            Employee::create($post);
            $this->flash('Medewerker toegevoegd.');
            header('Location: ?e=employees&a=index');
            exit;
        } catch (InvalidArgumentException $e) {
            $errors = json_decode($e->getMessage(), true) ?? ['_all' => 'Ongeldige invoer'];
            $this->create($post, $errors);
        }
    }

    public function edit(int $id, array $errors = []): void
    {
        $emp = Employee::find($id);
        if (!$emp) { $this->flash(err: 'Niet gevonden.'); header('Location: ?e=employees&a=index'); exit; }
        $old = [ 'id'=>$emp->getId(), 'name'=>$emp->getName(), 'email'=>$emp->getEmail(), 'role'=>$emp->getRole() ];
        $this->view->assign('action', 'update');
        $this->view->assign('old', $old);
        $this->view->assign('errors', $errors);
        $this->view->display('employees/form.tpl');
    }

    public function update(int $id, array $post): void
    {
        $emp = Employee::find($id);
        if (!$emp) { $this->flash(err: 'Niet gevonden.'); header('Location: ?e=employees&a=index'); exit; }
        try {
            $emp->update($post);
            $this->flash('Wijzigingen opgeslagen.');
            header('Location: ?e=employees&a=index');
            exit;
        } catch (InvalidArgumentException $e) {
            $errors = json_decode($e->getMessage(), true) ?? ['_all' => 'Ongeldige invoer'];
            $this->edit($id, $errors);
        }
    }

    public function delete(int $id): void
    {
        $emp = Employee::find($id);
        if ($emp) { $emp->delete(); $this->flash('Medewerker verwijderd.'); }
        header('Location: ?e=employees&a=index');
        exit;
    }
}