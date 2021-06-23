<?php

namespace YunLong\MSelect;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class MSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-admin-mselect'); // 视图目录指定
        Admin::booting(function () {
            Form::extend('mselect', MSelect::class);
        });
    }
}
