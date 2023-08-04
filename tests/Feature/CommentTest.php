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
        $comment->comment = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto distinctio, cumque nihil corporis perferendis nisi earum fuga ratione, consequatur asperiores quod debitis quaerat consectetur praesentium aliquam, error deleniti ex id!
        Reprehenderit ullam eveniet tenetur illum minima incidunt distinctio aliquid cupiditate possimus voluptas repudiandae quisquam blanditiis iusto labore nobis, quis facere? Rerum sapiente nesciunt atque voluptates sit totam minus, sed earum.
        Consequatur quidem libero labore expedita. Voluptatibus quibusdam nostrum culpa numquam dolore labore ratione quaerat voluptatum, distinctio non ab, ullam nihil architecto sed provident odit praesentium explicabo alias, perferendis earum. Dignissimos.
        Inventore alias similique, magnam quo accusantium consectetur commodi, veniam quam tempora officiis perferendis est illum porro voluptates aperiam possimus. Iusto, esse? Dolorem, quo? Perspiciatis in corporis labore maiores eos veritatis?
        Iure ut unde sit tempora? Vero ea tenetur earum, ipsum alias repellat, numquam ipsam libero dolorem laudantium itaque. Minima nisi iusto, quod temporibus totam amet aliquid ut accusantium. Quo, repudiandae.
        Inventore distinctio reprehenderit adipisci voluptas ut est, excepturi vel incidunt? Rem laboriosam nesciunt hic nulla corrupti assumenda delectus debitis, iure autem numquam soluta provident dolor, quo velit consectetur odio dolorum.
        Nemo repellendus blanditiis optio error repellat maiores hic, natus laborum? Reiciendis inventore eaque minima neque natus itaque ex nisi in ad cum sunt, nesciunt perferendis officiis fugiat. Rerum, quia laboriosam.
        Quo praesentium dolore in reprehenderit, quam dolor eligendi esse laborum atque alias soluta minima. Facilis, necessitatibus voluptatum voluptatem, architecto ad aliquid velit, deleniti eveniet mollitia accusamus doloremque perspiciatis impedit praesentium.
        Nam facilis, exercitationem error voluptates aut perspiciatis odit animi architecto rem cum excepturi aspernatur, laboriosam quia blanditiis tenetur praesentium. Dolorum dicta quam aspernatur porro ut modi possimus, quidem eaque est.";

        $comment->save();
        self::assertNotNull($comment->id);
    }
}
