<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EmployeesFixture
 */
class EmployeesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'first_name' => 'Lorem ipsum dolor sit amet',
                'middle_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'department_id' => 1,
                'date_of_birth' => '2025-04-06',
                'status' => 'Lorem ipsum dolor sit amet',
                'place_of_birth' => 'Lorem ipsum dolor sit amet',
                'qr_code' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-04-06 12:08:19',
                'modified' => '2025-04-06 12:08:19',
            ],
        ];
        parent::init();
    }
}
