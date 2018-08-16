<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProductCategoryTest extends DuskTestCase
{

    public function testCreateProductCategory()
    {
        $admin = \App\User::find(1);
        $product_category = factory('App\ProductCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $product_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_categories.index'))
                ->clickLink('Add new')
                ->type("name", $product_category->name)
                ->type("description", $product_category->description)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.product_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product_category->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $product_category->description)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\ProductCategory::first()->photo . "']")
                ->logout();
        });
    }

    public function testEditProductCategory()
    {
        $admin = \App\User::find(1);
        $product_category = factory('App\ProductCategory')->create();
        $product_category2 = factory('App\ProductCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $product_category, $product_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_categories.index'))
                ->click('tr[data-entry-id="' . $product_category->id . '"] .btn-info')
                ->type("name", $product_category2->name)
                ->type("description", $product_category2->description)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.product_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product_category2->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $product_category2->description)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\ProductCategory::first()->photo . "']")
                ->logout();
        });
    }

    public function testShowProductCategory()
    {
        $admin = \App\User::find(1);
        $product_category = factory('App\ProductCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $product_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_categories.index'))
                ->click('tr[data-entry-id="' . $product_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $product_category->name)
                ->assertSeeIn("td[field-key='description']", $product_category->description)
                ->logout();
        });
    }

}
