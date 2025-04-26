<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

/**
 * Attendances Controller
 *
 * @property \App\Model\Table\AttendancesTable $Attendances
 * @method \App\Model\Entity\Attendance[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AttendancesController extends AppController
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
        $this->paginate = [
            'contain' => ['Employees'],
        ];
        $attendances = $this->paginate($this->Attendances);

        $this->set(compact('attendances'));
    }

    /**
     * View method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => ['Employees'],
        ]);

        $this->set(compact('attendance'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $attendance = $this->Attendances->newEmptyEntity();
        if ($this->request->is('post')) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $employees = $this->Attendances->Employees->find('list', ['limit' => 200])->all();
        $this->set(compact('attendance', 'employees'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $attendance = $this->Attendances->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $attendance = $this->Attendances->patchEntity($attendance, $this->request->getData());
            if ($this->Attendances->save($attendance)) {
                $this->Flash->success(__('The attendance has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The attendance could not be saved. Please, try again.'));
        }
        $employees = $this->Attendances->Employees->find('list', ['limit' => 200])->all();
        $this->set(compact('attendance', 'employees'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Attendance id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $attendance = $this->Attendances->get($id);
        if ($this->Attendances->delete($attendance)) {
            $this->Flash->success(__('The attendance has been deleted.'));
        } else {
            $this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function scan(){
        
    }

    public function addAttendance()
    {
        $this->request->allowMethod(['post']);
        $this->autoRender = false;

        $data = $this->request->input('json_decode');

        $employeeId = $data->employee_id ?? null;

        if (!$employeeId) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'error', 'message' => 'Invalid QR Code']));
        }

        // Check if employee exists
        $employee = $this->Attendances->Employees->find()->where(['id' => $employeeId])->first();

        if (!$employee) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'error', 'message' => 'Employee not found']));
        }

        // Add attendance
        $attendance = $this->Attendances->newEmptyEntity();
        $attendance->employee_id = $employeeId;
        $attendance->check_in = FrozenTime::now();

        if ($this->Attendances->save($attendance)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'success', 'message' => 'Attendance recorded']));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['status' => 'error', 'message' => 'Failed to save attendance']));
    }

}
