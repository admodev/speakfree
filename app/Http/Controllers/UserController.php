<?php

namespace SpeakFree\Http\Controllers;

use Illuminate\Http\Request;
use SpeakFree\Helpers\ResponseHelper;

use SpeakFree\Domain\Users\UserRepositoryInterface;

class UserController extends Controller
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepo)
  {
    $this->userRepository = $userRepo;
  }

  public function index()
  {
    return ResponseHelper::createResponse($this->userRepository->all());
  }
}
