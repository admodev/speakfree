<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use SpeakFree\Domain\Constants\UsersConstants;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create(UsersConstants::USERS_TABLE_NAME, function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('last_name');
      $table->string('email')->unique();
      $table->string('phone_number')->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
      $table->timestamp('deleted_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists(UsersConstants::USERS_TABLE_NAME);
  }
};
