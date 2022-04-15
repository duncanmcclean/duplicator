<?php

namespace DoubleThreeDigital\Duplicator\Tests\Actions;

use DoubleThreeDigital\Duplicator\Actions\DuplicateTermAction;
use DoubleThreeDigital\Duplicator\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Statamic\Facades\Term;

class DuplicateTermActionTest extends TestCase
{
    public $user;
    public $action;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->makeStandardUser();
        $this->action = new DuplicateTermAction();
    }

    /** @test */
    public function cant_get_field_items_for_single_site()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function can_get_field_items_for_multi_site()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function is_visible_for_terms()
    {
        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'dance', $this->user);

        $visible = $this->action->visibleTo($term);

        $this->assertTrue($visible);
    }

    /** @test */
    public function is_not_visible_for_non_terms()
    {
        $taxonomy = $this->makeTaxonomies('categories', 'Categories');

        $visible = $this->action->visibleTo($taxonomy);

        $this->assertFalse($visible);
    }

    /** @test */
    public function can_duplicate_term()
    {
        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'haggis', $this->user);

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('haggis-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'haggis-1');
    }

    /** @test */
    public function can_duplicate_entry_with_config_publish_state()
    {
        $this->markTestIncomplete();

        Config::set('duplicator.defaults.published', false);

        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'haggis', $this->user);

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('haggis-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'haggis-1');
        $this->assertSame($duplicateTerm->published(), false);
    }

    /** @test */
    public function can_duplicate_entry_with_duplicated_entry_publish_state()
    {
        $this->markTestIncomplete();

        Config::set('duplicator.defaults.published', null);

        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'haggis', $this->user);

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('haggis-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'haggis-1');
        $this->assertSame($duplicateTerm->published(), false);
    }

    /** @test */
    public function can_duplicate_entry_for_different_site()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function can_duplicate_term_with_ignored_fields()
    {
        Config::set('duplicator.ignored_fields.terms.categories', ['special_category']);

        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'haggis', $this->user);

        $term->set('special_category', 'special');
        $term->save();

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('haggis-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'haggis-1');
        $this->assertNull($duplicateTerm->get('special_category'));
    }

    /** @test */
    public function can_duplicate_entry_with_fingerprinting_enabled()
    {
        Config::set('duplicator.fingerprint', true);

        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'spaghetti', $this->user);

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('spaghetti-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'spaghetti-1');

        $this->assertTrue($duplicateTerm->get('is_duplicate'));
    }

    /** @test */
    public function can_duplicate_entry_with_fingerprinting_disabled()
    {
        Config::set('duplicator.fingerprint', false);

        $taxonomy = $this->makeTaxonomies('categories', 'Categories');
        $term = $this->makeTerm('categories', 'cheese', $this->user);

        $duplicate = $this->action->run(collect([$term]), []);

        $duplicateTerm = Term::findBySlug('cheese-1', 'categories');

        $this->assertIsObject($duplicateTerm);
        $this->assertSame($duplicateTerm->slug(), 'cheese-1');

        $this->assertNull($duplicateTerm->get('is_duplicate'));
    }
}
