<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    /**
     * PHPUnit-specific: runs before any test
     *
     * @return void
     */
    public function setUp()
    {
        $this->user = new \App\Models\User;
    }

    /** @test */
    public function alternativeWayToRunTests()
    {
        $this->assertTrue(true); // Try changing it to false
    }

    public function testThatWeCanGetTheFirstName()
    {
        $this->user->firstName('Alain');
        $this->assertEquals($this->user->firstName(), 'Alain');
    }

    public function testThatWeCanGetTheLastName()
    {
        $this->user->lastName("D'Ettorre");
        $this->assertEquals($this->user->lastName(), "D'Ettorre");
    }

    public function testFullNameIsReturned()
    {
        $this->user->firstName('Alain');
        $this->user->lastName("D'Ettorre");
        $this->assertEquals($this->user->fullName(), "Alain D'Ettorre");
    }

    public function testFirstAndLastNameAreTrimmed()
    {
        $this->user->firstName('  Alain    ');
        $this->user->lastName("    D'Ettorre ");
        $this->assertEquals($this->user->firstName(), 'Alain');
        $this->assertEquals($this->user->lastName(), "D'Ettorre");
        $this->assertEquals($this->user->fullName(), "Alain D'Ettorre");
    }

    public function testEmailAddressCanBeSet()
    {
        $email = 'alain@alaindettorre.com';
        $this->user->email($email);
        $this->assertEquals($this->user->email(), $email);
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $firstname = '  Alain    ';
        $lastname = "      D'Ettorre   ";
        $fullname = "Alain D'Ettorre";
        $email = 'alain@alaindettorre.com';
        $this->user->firstName($firstname);
        $this->user->lastName($lastname);
        $this->user->email($email);
        $emailVariables = $this->user->emailVariables();
        $this->assertArrayHasKey('fullname', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);
        $this->assertEquals($emailVariables['fullname'], $fullname);
        $this->assertEquals($emailVariables['email'], $email);
    }
}
