<?php

namespace SpeakFree\Domain\Users;

use SpeakFree\Domain\Repository;

use SpeakFree\Domain\Users\User;
use SpeakFree\Domain\Users\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface {
  protected $modelClassName = User::class;
}
