<?php

namespace SpeakFree\Domain\Constants;

class HttpConstants
{
  // Codes
  const OKAY_CODE = 200;
  const RESOURCE_UPDATED_CODE = 201;
  const BAD_REQUEST_CODE = 400;
  const UNAUTHORIZED_CODE = 401;
  const UNPROCESSABLE_ENTITY_CODE = 422;

  // Messages
  const OKAY_MESSAGE = 'okay';
  const SUCCESS_MESSAGE = 'success';
  const RESOURCE_UPDATED_MESSAGE = 'updated';
  const BAD_REQUEST_MESSAGE = 'bad_request';
  const UNAUTHORIZED_MESSAGE = 'unauthorized';
  const UNPROCESSABLE_ENTITY_MESSAGE = 'unprocessable_entity';
}
