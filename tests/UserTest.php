<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  public function testIsValidWithValidUser()
  {
    $user = new User('test@example.com', 'Doe', 'John', new DateTime('1990-01-01'));
    $this->assertTrue($user->isValid());
    $this->assertEmpty($user->getErrors());
  }

  public function testIsValidWithInvalidEmail()
  {
    $user = new User('invalid_email', 'Doe', 'John', new DateTime('1990-01-01'));
    $this->assertFalse($user->isValid());
    $this->assertNotEmpty($user->getErrors());
    $this->assertContainsOnlyInstancesOf(Exception::class, $user->getErrors());
    $this->assertContains('Email is not valid', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
  }

  public function testIsValidWithNullProperties()
  {
    $user = new User();
    $this->assertFalse($user->isValid());
    $this->assertNotEmpty($user->getErrors());
    $this->assertContainsOnlyInstancesOf(Exception::class, $user->getErrors());
    $this->assertContains('Property email is empty', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
    $this->assertContains('Property lastname is empty', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
    $this->assertContains('Property firstname is empty', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
    $this->assertContains('Property birthdate is empty', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
  }

  public function testIsValidWithUnderageUser()
  {
    $user = new User('test@example.com', 'Doe', 'John', new DateTime('2015-01-01'));
    $this->assertFalse($user->isValid());
    $this->assertNotEmpty($user->getErrors());
    $this->assertContainsOnlyInstancesOf(Exception::class, $user->getErrors());
    $this->assertContains('User must be at least 13 years old', array_map(fn ($error) => $error->getMessage(), $user->getErrors()));
  }
}
