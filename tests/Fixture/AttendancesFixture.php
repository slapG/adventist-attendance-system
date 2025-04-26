<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendancesFixture
 */
class AttendancesFixture extends TestFixture
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
                'employee_id' => 1,
                'check_in' => '2025-04-06 12:08:18',
                'check_out' => '2025-04-06 12:08:18',
                'created' => '2025-04-06 12:08:18',
                'modified' => '2025-04-06 12:08:18',
            ],
        ];
        parent::init();
    }
}
