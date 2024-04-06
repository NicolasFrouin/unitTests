<?php

class User
{
  private ?string $email;
  private ?string $lastname;
  private ?string $firstname;
  private ?DateTime $birthdate;
  private array $errors = [];

  public function __construct(string $email = null, string $lastname = null, string $firstname = null, DateTime $birthdate = null)
  {
    $this->email = $email;
    $this->lastname = $lastname;
    $this->firstname = $firstname;
    $this->birthdate = $birthdate;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function isValid(): bool
  {
    foreach (get_object_vars($this) as $property => $value) {
      if ($property !== "errors" && empty($value)) {
        $this->errors[] = new Exception("Property $property is empty");
      }
    }
    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = new Exception("Email is not valid");
    }
    if ($this->birthdate?->getTimestamp() > strtotime("13 years ago")) {
      $this->errors[] = new Exception("User must be at least 13 years old");
    }
    return empty($this->errors);
  }
}
