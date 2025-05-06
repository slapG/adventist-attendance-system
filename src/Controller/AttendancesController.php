<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;
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
        
        $attendances = $this->Attendances->find('all', [
            'contain' => ['Employees', 'Employees.Departments'],
        ]);
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

                return $this->redirect(['action' => 'add']);
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

        $employee = $this->Attendances->Employees->find()->where(['id' => $employeeId])->first();
        if (!$employee) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'error', 'message' => 'Employee not found']));
        }

        $now = FrozenTime::now();
        $startOfDay = $now->startOfDay();
        $endOfDay = $now->endOfDay();

        $sixAM = $now->setTime(9, 59, 0);
        $eightAM = $now->setTime(22, 0, 0);

        if ($now < $sixAM || $now > $eightAM) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'error', 'message' => 'Attendance can only be recorded between 6 AM and 8 AM']));
        }

        $existingAttendance = $this->Attendances->find()
            ->where([
                'employee_id' => $employeeId,
                'check_in >=' => $startOfDay,
                'check_in <=' => $endOfDay
            ])
            ->first();

        if ($existingAttendance) {
            if ($existingAttendance->check_out === null){
                $existingAttendance->check_out = $now;
                if ($this->Attendances->save($existingAttendance)) {
                    return $this->response->withType('application/json')
                        ->withStringBody(json_encode(['status' => 'success', 'message' => 'Time out successfully']));
                } else {
                    return $this->response->withType('application/json')
                        ->withStringBody(json_encode(['status' => 'error', 'message' => 'Failed to save check-out']));
                }
            } else {
                return $this->response->withType('application/json')
                    ->withStringBody(json_encode(['status' => 'error', 'message' => 'Already Taken Time out']));
            }
        }

        $attendance = $this->Attendances->newEmptyEntity();
        $attendance->employee_id = $employeeId;
        $attendance->check_in = $now;

        if ($this->Attendances->save($attendance)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['status' => 'success', 'message' => 'Time in successfully']));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['status' => 'error', 'message' => 'Failed to save check-in']));
    } 
}
