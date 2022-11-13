<?php

namespace SpeakFree\Domain\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SpeakFree\Domain\Constants\PostsConstants;

class Post extends Model
{
  use HasFactory, SoftDeletes;

  /**
   * Database table name for the model.
   */
  protected $table = PostsConstants::POSTS_TABLE_NAME;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'content',
    'posted_by'
  ];
}
