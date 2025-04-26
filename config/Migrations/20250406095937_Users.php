<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Users extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('username', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();     

        $table = $this->table('departments');
        $table->addColumn('department', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();

        $table = $this->table('employees');
        $table->addColumn('first_name', 'string')
            ->addColumn('middle_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('department_id', 'integer')
            ->addColumn('date_of_birth', 'date')
            ->addColumn('status', 'string')
            ->addColumn('place_of_birth', 'string')
            ->addColumn('qr_code', 'string', ['null'=> true])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addForeignKey('department_id', 'departments', ['id'])
            ->create();

        $table = $this->table('attendances');
        $table->addColumn('employee_id', 'integer')
            ->addColumn('check_in', 'datetime')
            ->addColumn('check_out', 'datetime')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addForeignKey('employee_id', 'employees', ['id'])
            ->create();

    }
}
