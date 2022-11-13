<?php

namespace SpeakFree\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use SpeakFree\Domain\Constants\HttpConstants;
use SpeakFree\Helpers\ResponseHelper;
use SpeakFree\Domain\Users\UserRepository;
use SpeakFree\Helpers\ExceptionLogHelper;
use SpeakFree\Helpers\PostRequestValidator;

class UserController extends Controller
{
  protected $userRepository;

  public function __construct(UserRepository $userRepo)
  {
    $this->userRepository = $userRepo;
  }

  public function index()
  {
    return ResponseHelper::createResponse($this->userRepository->all(), HttpConstants::OKAY_CODE);
  }

  public function store(Request $request)
  {
    $fields = $request->except('token');
    $fields['password'] = bcrypt($fields['password']);

    $this->validateUserCreation($fields);
    $this->createValidatedUser($fields);

    $responseMessage = ResponseHelper::createResponse('user created successfully', HttpConstants::OKAY_CODE);

    return redirect()->route('home.view', ['responseMessage' => $responseMessage]);
  }

  protected function createValidatedUser($userData)
  {
    try {
      return $this->userRepository->create($userData);
    } catch (Exception $error) {
      return ExceptionLogHelper::logException($error);
    }
  }

  protected function validateUserCreation(array $userData)
  {
    try {
      $rules = [
        'name' => 'string|required',
        'last_name' => 'string|required',
        'email' => 'email|required|unique:user,email',
        'password' => 'string|required|min:8',
        'phone_number' => 'string'
      ];

      return PostRequestValidator::validatePostRequestFields($userData, $rules);
    } catch (Exception $error) {
      return ExceptionLogHelper::logException($error);
    }
  }
}
