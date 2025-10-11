
<?php
class User {
  public int $id;
  public string $email;
  public string $passwordHash; #we gotta hash this shit
  public string $firstName;
  public string $lastName;
  public string $address;
  public string $createdAt;

  }