<?php

namespace Tests\Models;

use Portal\Models\ApplicantsModel;
use Tests\TestCase;

class ApplicantsModelTest extends TestCase
{
    public function testConstruct(): void
    {
        $db = $this->createMock(\PDO::class);
        $case = new ApplicantsModel($db);
        $this->assertInstanceOf(ApplicantsModel::class, $case);
    }
    public function testAddApplicants(): void
    {
        $db = $this->createMock(\PDO::class);

        $PDOStatement = $this->createMock(\PDOStatement::class);
        $db->expects($this->once())
            ->method('prepare')
            ->with(
                'INSERT INTO `applicants` (`name`, `email`, `application_date`) VALUES (:name, :email, :application_date)')
            ->willReturn($PDOStatement);

        $PDOStatement->expects($this->once())
            ->method('execute')
            ->with([
                ':name' => 'John Doe',
                ':email' => 'john.doe@example.com',
                ':application_date' => '2024-11-18'
            ])
            ->willReturn(true);

        $model = new ApplicantsModel($db);
        $result = $model->addApplicants('John Doe', 'john.doe@example.com', '2024-11-18');

        $this->assertTrue($result, 'addApplicants should return true on successful insertion.');
    }
}
