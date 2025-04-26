<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property int $department_id
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $status
 * @property string $place_of_birth
 * @property string|null $qr_code
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Attendance[] $attendances
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'first_name' => true,
        'middle_name' => true,
        'last_name' => true,
        'department_id' => true,
        'date_of_birth' => true,
        'status' => true,
        'place_of_birth' => true,
        'qr_code' => true,
        'created' => true,
        'modified' => true,
        'department' => true,
        'attendances' => true,
    ];
}
