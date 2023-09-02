<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use Config\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\HTTP\Files\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;


class EmployeeController extends BaseController
{
    public function index()
    {
        if (! auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        $employeeModel = new EmployeeModel();
        $data = [
            'employee' => $employeeModel->where('user_id', auth()->id())->paginate(2),
            'pager' => $employeeModel->pager
        ];


        return view('employee/index', $data);
    }

    public function create()
    {
        if(! auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        return view('employee/create');
    }

    public function store()
    {
        if(! auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];

        $result = array();
        
        // check same length for name and email arrays
        if (count($data['name']) == count($data['email'])) {
            $db      = \Config\Database::connect();
            
            for ($i = 0; $i < count($data['name']); $i++) {
                $result[] = [
                    'name' => $data['name'][$i], 
                    'email' => $data['email'][$i],
                    'user_id' => auth()->id()
                ];
            }

            try {
                $db->table('employee')->insertBatch($result);
            } catch (\Throwable $th) {
                return redirect()->to('employee/create');
            }

            return redirect()->to('employee');

        } else {
            dd("Oops!");
            echo "Input arrays have different lengths";
        }
    }

    public function edit($id = null)
    {
        if(! auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        if($id == null) return view('employee');
        $employeeModel = new EmployeeModel();
        $data['employee'] = $employeeModel->where('id', $id)->first();
        return view('/employee/edit', $data);
    }

    public function update()
    {
        if(! auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        $employeeModel = new EmployeeModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email')
        ];
        $employeeModel->update($id, $data);

        return redirect()->to('/employee');
    }

    public function delete($id = null)
    {
        if(! auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        if($id == null) return view('employee/inde');
        $employeeModel = new EmployeeModel();
        $employeeModel->where('id', $id)->delete();
        return redirect()->to('/employee');
    }

    public function export() 
    {

        $employeeModel = new EmployeeModel();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // add headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');

        $employeeData = $employeeModel->where('user_id', auth()->id())->findAll();

        $row = 2; // Start from row 2 to leave room for headers
        foreach ($employeeData as $employee) {
            $sheet->setCellValue('A' . $row, $employee['id']);
            $sheet->setCellValue('B' . $row, $employee['name']);
            $sheet->setCellValue('C' . $row, $employee['email']);
            $row++;
        }

        $filename = 'employee_data.xlsx';

        $writer = new Xlsx($spreadsheet);

        // set header for browser download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // write
        $writer->save('php://output');
    }

    public function import() 
    {
        $maxEmployeeCount = 50;
        dd('max');
        $file = $this->request->getFile('excel_file');

        if ($file->isValid() && $file->getExtension() === 'xlsx') {
            $spreadsheet = IOFactory::load($file->getTempName());
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();
            if (count($data) > $maxEmployeeCount) {
                dd(
                    "handle max emp count here"
                );
                return redirect()->to("/employee");
            }
            $employeeModel = new EmployeeModel();
            dd(
                'hey'
            );
            foreach ($data as $key=>$row) {
                if($key != 0) {
                    $id = $row[0];
                    $name = $row[1];
                    $email = $row[2];

                    $existingEmployee = $employeeModel->find($id);
                    dd(
                        $existingEmployee, 'hey'
                    );
                    if ($existingEmployee) {
                        dd('1');
                        $employeeModel->update($id, [
                            'name' => $name,
                            'email' => $email
                        ]);
                    } else {
                        dd('2');
                        $employeeModel->insert([
                            'name' => $name,
                            'email' => $email,
                            'user_id' => auth()->id()
                        ]);
                    }
                }
                
            }

            return redirect()->to("/employee");
        } else {
            dd("Oops Failed handle error here");
            return redirect()->to("/employee");
        }
    }
    

}
