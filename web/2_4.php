<?php 

  class User {
    public $name;
    public $age;

    // Runs when project is created
    public function __construct($name, $age){
      echo 'Class ' . __CLASS__ . ' instantiated<br>';
      $this->name = $name;
      $this->age = $age;
    }

    public function sayHello(){
      return $this->name . ' Says Hello';
    }

    // Called when there is no other references to a certain object
    // Used for cleanup, closing connections etc
    public function __destruct(){
      echo 'dextructor ran...';
    }
  }

  $user1 = new User('Laurynas', 29);
  $user2 = new User('Paul', 35);

  echo $user1->name . ' is ' . $user1->age .' years old';
  echo '<br>';
  echo $user1->sayHello();
  echo '<br>';
  echo $user2->name . ' is ' . $user2->age .' years old';
  echo '<br>';
  echo $user2->sayHello();
  echo '<br>';