<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProductTest extends DuskTestCase
{

    public function testCreateProduct()
    {
        $admin = \App\User::find(1);
        $product = factory('App\Product')->make();

        $relations = [
            factory('App\ProductCategory')->create(), 
            factory('App\ProductCategory')->create(), 
            factory('App\ProductTag')->create(), 
            factory('App\ProductTag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $product, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.products.index'))
                ->clickLink('Add new')
                ->type("name", $product->name)
                ->type("description", $product->description)
                ->type("price", $product->price)
                ->select('select[name="category[]"]', $relations[0]->id)
                ->select('select[name="category[]"]', $relations[1]->id)
                ->select('select[name="tag[]"]', $relations[2]->id)
                ->select('select[name="tag[]"]', $relations[3]->id)
                ->attach("photo1", base_path("tests/_resources/test.jpg"))
                ->attach("photo2", base_path("tests/_resources/test.jpg"))
                ->attach("photo3", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.products.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $product->description)
                ->assertSeeIn("tr:last-child td[field-key='price']", $product->price)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:last-child", $relations[3]->name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo1 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo2 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo3 . "']")
                ->logout();
        });
    }

    public function testEditProduct()
    {
        $admin = \App\User::find(1);
        $product = factory('App\Product')->create();
        $product2 = factory('App\Product')->make();

        $relations = [
            factory('App\ProductCategory')->create(), 
            factory('App\ProductCategory')->create(), 
            factory('App\ProductTag')->create(), 
            factory('App\ProductTag')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $product, $product2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.products.index'))
                ->click('tr[data-entry-id="' . $product->id . '"] .btn-info')
                ->type("name", $product2->name)
                ->type("description", $product2->description)
                ->type("price", $product2->price)
                ->select('select[name="category[]"]', $relations[0]->id)
                ->select('select[name="category[]"]', $relations[1]->id)
                ->select('select[name="tag[]"]', $relations[2]->id)
                ->select('select[name="tag[]"]', $relations[3]->id)
                ->attach("photo1", base_path("tests/_resources/test.jpg"))
                ->attach("photo2", base_path("tests/_resources/test.jpg"))
                ->attach("photo3", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.products.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $product2->description)
                ->assertSeeIn("tr:last-child td[field-key='price']", $product2->price)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:last-child", $relations[3]->name)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo1 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo2 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Product::first()->photo3 . "']")
                ->logout();
        });
    }

    public function testShowProduct()
    {
        $admin = \App\User::find(1);
        $product = factory('App\Product')->create();

        $relations = [
            factory('App\ProductCategory')->create(), 
            factory('App\ProductCategory')->create(), 
            factory('App\ProductTag')->create(), 
            factory('App\ProductTag')->create(), 
        ];

        $product->category()->attach([$relations[0]->id, $relations[1]->id]);
        $product->tag()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $product, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.products.index'))
                ->click('tr[data-entry-id="' . $product->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $product->name)
                ->assertSeeIn("td[field-key='description']", $product->description)
                ->assertSeeIn("td[field-key='price']", $product->price)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='category'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='tag'] span:last-child", $relations[3]->name)
                ->logout();
        });
    }

}
