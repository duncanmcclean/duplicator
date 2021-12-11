<?php

namespace DoubleThreeDigital\Duplicator\Tests;

use DoubleThreeDigital\Duplicator\ServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Statamic\Contracts\Auth\User as AuthUser;
use Statamic\Extend\Manifest;
use Statamic\Facades\Blueprint;
use Statamic\Facades\Collection;
use Statamic\Facades\Entry;
use Statamic\Facades\Taxonomy;
use Statamic\Facades\Term;
use Statamic\Facades\User;
use Statamic\Providers\StatamicServiceProvider;
use Statamic\Stache\Stache;
use Statamic\Statamic;

abstract class TestCase extends OrchestraTestCase
{
    use WithFaker;

    protected function getPackageProviders($app)
    {
        return [
            StatamicServiceProvider::class,
            ServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Statamic' => Statamic::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app->make(Manifest::class)->manifest = [
            'doublethreedigital/duplicator' => [
                'id' => 'doublethreedigital/duplicator',
                'namespace' => 'DoubleThreeDigital\\Duplicator\\',
            ],
        ];
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $configs = [
            'assets', 'cp', 'forms', 'static_caching',
            'sites', 'stache', 'system', 'users',
        ];

        foreach ($configs as $config) {
            $app['config']->set("statamic.$config", require(__DIR__."/../vendor/statamic/cms/config/{$config}.php"));
        }

        $app['config']->set('statamic.users.repository', 'file');
        $app['config']->set('statamic.stache', require(__DIR__.'/__fixtures__/config/statamic/stache.php'));

        Blueprint::setDirectory(__DIR__.'/__fixtures__/resources/blueprints');
    }

    public function makeStandardUser()
    {
        return User::make()
            ->id((new Stache())->generateId())
            ->email($this->faker->email);
    }

    public function makeCollection(string $handle, string $name)
    {
        Collection::make($handle)
            ->title($name)
            ->pastDateBehavior('public')
            ->futureDateBehavior('private')
            ->save();

        return Collection::findByHandle($handle);
    }

    public function makeEntry(string $collectionHandle, string $slug, AuthUser $user)
    {
        Entry::make()
            ->collection($collectionHandle)
            ->locale('default')
            ->published(true)
            ->slug($slug)
            ->data([
                'summary' => $this->faker->text,
            ])
            ->set('updated_by', $user->id)
            ->set('updated_at', now()->timestamp)
            ->save();

        return Entry::findBySlug($slug, $collectionHandle);
    }

    protected function makeTaxonomies(string $handle, string $name)
    {
        Taxonomy::make($handle)
            ->title($name)
            ->save();

        return Taxonomy::findByHandle($handle);
    }

    protected function makeTerm(string $taxonomyHandle, string $slug, AuthUser $user)
    {
        Term::make($slug)
            ->taxonomy($taxonomyHandle)
            ->data([
                'title' => 'Blah blah blah',
                'text' => $this->faker->text,
            ])
            ->save();

        return Term::findBySlug($slug, $taxonomyHandle);
    }
}
