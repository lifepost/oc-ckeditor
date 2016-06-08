<?php namespace Teb\WysiwygEditors\models;

use October\Rain\Database\Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'teb_wysiwygeditors_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];

    public $attachMany = [
      'template_image_as_wysiwyg' => 'System\Models\File'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        self::observe(new SettingsObservers);
    }


    public function afterModelSave()
    {
        error_log('after model save');
    }


}
