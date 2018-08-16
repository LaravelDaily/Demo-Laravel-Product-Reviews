<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProductTagTest extends DuskTestCase
{

    public function testCreateProductTag()
    {
        $admin = \App\User::find(1);
        $product_tag = factory('App\ProductTag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $product_tag) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_tags.index'))
                ->clickLink('Add new')
                ->type("name", $product_tag->name)
                ->press('Save')
                ->assertRouteIs('admin.product_tags.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product_tag->name)
                ->logout();
        });
    }

    public function testEditProductTag()
    {
        $admin = \App\User::find(1);
        $product_tag = factory('App\ProductTag')->create();
        $product_tag2 = factory('App\ProductTag')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $product_tag, $product_tag2) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_tags.index'))
                ->click('tr[data-entry-id="' . $product_tag->id . '"] .btn-info')
                ->type("name", $product_tag2->name)
                ->press('Update')
                ->assertRouteIs('admin.product_tags.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $product_tag2->name)
                ->logout();
        });
    }

    public function testShowProductTag()
    {
        $admin = \App\User::find(1);
        $product_tag = factory('App\ProductTag')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $product_tag) {
            $browser->loginAs($admin)
                ->visit(route('admin.product_tags.index'))
                ->click('tr[data-entry-id="' . $product_tag->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $product_tag->name)
                ->logout();
        });
    }

}
