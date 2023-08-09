<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createCommentsProduct();
        $this->createCommentsVoucher();
    }

    private function createCommentsProduct(): void
    {
        $product = Product::query()->find("1");

        $comment = new Comment();
        $comment->email = "vicky@contoh.co.id";
        $comment->title = "title anything";
        $comment->commentable_id = $product->id;
        $comment->commentable_type = 'product';
        $comment->save();
    }
    private function createCommentsVoucher(): void
    {
        $voucher = Voucher::query()->first();

        $comment = new Comment();
        $comment->email = "vicky@contoh.co.id";
        $comment->title = "title anything";
        $comment->commentable_id = $voucher->id;
        $comment->commentable_type = 'voucher';
        $comment->save();
    }
}
