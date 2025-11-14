<?php
namespace App\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Smarty\Smarty;

class RosterController
{
    public function __construct(private Smarty $view) {}

    public function index(): void
    {
        $employees = Employee::all();
        $employeeId = isset($_GET['employee_id']) ? (int)$_GET['employee_id'] : null;

        // Datumrange (optioneel in query): from/to (YYYY-MM-DD). Default: vandaag t/m +14 dagen
        $from = $_GET['from'] ?? date('Y-m-d');
        $to   = $_GET['to']   ?? date('Y-m-d', strtotime('+14 days'));
        $shifts = [];
        if ($employeeId) {
            $shifts = Shift::forEmployee($employeeId, $from, $to);
        }

        $this->view->assign('employees', $employees);
        $this->view->assign('selected_employee_id', $employeeId);
        $this->view->assign('from', $from);
        $this->view->assign('to', $to);
        $this->view->assign('shifts', $shifts);
        $this->view->display('roster/index.tpl');
    }
}