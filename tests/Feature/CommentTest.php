<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function testInsertComment()
    {
        $comment = new Comment();
        $comment->email = "eko@pzn.org";
        $comment->title = "Test title";
        $comment->comment = "Sample Comment";
        $comment->save();
        self::assertNotNull($comment->id);
    }

    public function testDefaultAttValues(){
        $comment = new Comment();
        $comment->email = "eko@pzn.org";

        $comment->save();
        self::assertNotNull($comment->id);
        self::assertNotNull($comment->title);
        self::assertNotNull($comment->comment);
    }
}
