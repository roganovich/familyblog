<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Moderate.
 *
 * Here you can remove builtin form field:
 * Encore\Moderate\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Moderate\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Moderate::css('/packages/prettydocs/css/styles.css');
 * Moderate::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);
