<?php

namespace SpeakFree\Domain\Posts;

use SpeakFree\Domain\Repository;

use SpeakFree\Domain\Posts\Post;
use SpeakFree\Domain\Posts\PostRepositoryInterface;

class PostRepository extends Repository implements PostRepositoryInterface {
  protected $modelClassName = Post::class;
}
