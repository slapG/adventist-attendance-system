<?php
declare(strict_types=1);

namespace App\Controller;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Cake\Filesystem\Folder;
/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('mazer');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $employees = $this->Employees->find('all', [
            'contain' => ['Departments'],
        ]);

        $this->set(compact('employees'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => ['Departments', 'Attendances'],
        ]);

        $this->set(compact('employee'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEmptyEntity();
    
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
    
            if ($employee->getErrors()) {
                $this->Flash->error(__('Validation failed: ' . json_encode($employee->getErrors())));
                return $this->redirect(['action' => 'add']);
            }
    
            if ($this->Employees->save($employee)) {
                $employeeId = $employee->last_name . $employee->first_name . $employee->middle_name;
    
                $qrCode = new QrCode((string)$employeeId);  
    
                $qrImagePath = WWW_ROOT . 'img' . DS . 'qrcodes' . DS . "{$employeeId}.png";
                $relativePath = 'qrcodes/' . $employeeId . '.png';  
    
                $folder = new Folder(WWW_ROOT . 'img' . DS . 'qrcodes', true, 0755);
    
                $writer = new PngWriter();
                try {
                    $writer->write($qrCode)->saveToFile($qrImagePath); 
                } catch (\Exception $e) {
                    $this->Flash->error(__('QR Code generation failed: ' . $e->getMessage()));
                    return $this->redirect(['action' => 'add']);
                }
    
                $employee->qr_code = $relativePath;  
    
                if (!$this->Employees->save($employee)) {
                    $this->Flash->error(__('Unable to save employee with QR code.'));
                    return $this->redirect(['action' => 'add']);
                }
    
                $this->Flash->success(__('Employee added and QR code generated.'));
                return $this->redirect(['action' => 'index']);
            }
    
            $this->Flash->error(__('Unable to add employee.'));
        }
    
        $departments = $this->Employees->Departments->find('list');
        $this->set(compact('employee', 'departments'));
    }
    

    /**
     * Edit method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $departments = $this->Employees->Departments->find('list', ['limit' => 200])->all();
        $this->set(compact('employee', 'departments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $employee = $this->Employees->get($id);
        if ($this->request->is('ajax')){
            if ($this->Employees->delete($employee)) {
                $this->response = $this->response->withType('json')
                ->withStringBody(json_encode(['status' => 'succcess', 'redirect' => true]));
            } else {
                $this->response = $this->response->withType('json')
                ->withStringBody(json_encode(['status' => 'error', 'redirect' => false]));
            }
            return $this->response;
        }
    }
}
