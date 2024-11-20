<?php

namespace Modules\Iprice\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iprice\Listeners\RegisterIpriceSidebar;

class IpriceServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIpriceSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            // append translations
        });


    }

    public function boot()
    {
       
        $this->publishConfig('iprice', 'config');
        $this->publishConfig('iprice', 'crud-fields');

        $this->mergeConfigFrom($this->getModuleConfigFilePath('iprice', 'settings'), "asgard.iprice.settings");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iprice', 'settings-fields'), "asgard.iprice.settings-fields");
        $this->mergeConfigFrom($this->getModuleConfigFilePath('iprice', 'permissions'), "asgard.iprice.permissions");

        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iprice\Repositories\PriceRepository',
            function () {
                $repository = new \Modules\Iprice\Repositories\Eloquent\EloquentPriceRepository(new \Modules\Iprice\Entities\Price());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iprice\Repositories\Cache\CachePriceDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iprice\Repositories\TariffRepository',
            function () {
                $repository = new \Modules\Iprice\Repositories\Eloquent\EloquentTariffRepository(new \Modules\Iprice\Entities\Tariff());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iprice\Repositories\Cache\CacheTariffDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iprice\Repositories\TariffableRepository',
            function () {
                $repository = new \Modules\Iprice\Repositories\Eloquent\EloquentTariffableRepository(new \Modules\Iprice\Entities\Tariffable());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iprice\Repositories\Cache\CacheTariffableDecorator($repository);
            }
        );
// add bindings



    }


}
