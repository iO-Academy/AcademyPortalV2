<?php

namespace Tests\Entities;

use Portal\Entities\Applicant;
use Portal\ValueObjects\EmailAddress;
use Tests\TestCase;

class ApplicantEntityTest extends TestCase
{
    public function testConstruct(): void
    {
        $email = $this->createMock(EmailAddress::class);
        $case = new Applicant(1, 'test', $email, '2024-01-01');
        $this->assertInstanceOf(Applicant::class, $case);
    }

    public function testGetFormattedApplicationDate(): void
    {
        $email = $this->createMock(EmailAddress::class);
        $entity = new Applicant(1, 'test', $email, '2024-01-01');
        $expected = '1st January, 2024';
        $actual = $entity->getFormattedApplicationDate();
        $this->assertEquals($expected, $actual);
    }
}
