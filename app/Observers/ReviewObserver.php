<?php

namespace App\Observers;

use App\Product;
use App\Review;
use App\Scopes\ProductUserScope;

class ReviewObserver
{
    /**
     * Handle the review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        $this->recalculateProductRating($review->product_id);
    }

    /**
     * Handle the review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        $this->recalculateProductRating($review->product_id);
    }

    private function recalculateProductRating($product_id)
    {
        $product = Product::withoutGlobalScope(ProductUserScope::class)->with('reviews')->find($product_id);
        $avg_rating = 0;
        if ($product->reviews()->count()) {
            $avg_rating = $product->reviews()->avg('rating');
        }
        $product->update([
            'avg_rating' => $avg_rating,
            'reviews_count' => $product->reviews()->count()
        ]);
    }

}
