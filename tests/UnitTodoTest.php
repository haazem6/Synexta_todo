<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Todo;
class UnitTodoTest extends TestCase
{
    public function testToArray()
    {

    $todo = new Todo();
        $todo->setTask('Example Task');
        $todo->setDescription('Example Description');
        $todo->setStartDate('2023-01-01');
        $todo->setEndDate('2023-01-31');
        $todo->setPlace('Example Place');

        $expectedArray = [
            'id' => null,
            'task' => 'Example Task',
            'description' => 'Example Description',
            'start_date' => '2023-01-01',
            'end_date' => '2023-01-31',
            'place' => 'Example Place',
        ];

        $this->assertEquals($expectedArray, $todo->toArray());
}
}
