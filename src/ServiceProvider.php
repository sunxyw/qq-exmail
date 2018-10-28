<?php

namespace Sunxyw\QqExmail;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(QqExmail::class, function () {
            return new QqExmail(
                config('services.qqexmail.corpid'),
                config('services.qqexmail.corpsecret')
            );
        });

        $this->app->alias(QqExmail::class, 'QqExmail');
    }

    public function provides()
    {
        return [QqExmail::class, 'QqExmail'];
    }
}