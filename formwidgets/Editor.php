<?php namespace Teb\WysiwygEditors\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Teb\WysiwygEditors\Models\Settings;
use App;
use File;

class Editor extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name'        => 'teb.wysiwygeditors::lang.widget.name',
            'description' => 'teb.wysiwygeditors::lang.widget.description'
        ];
    }

    public function render()
    {
        $this->prepareVars();
        $editor = Settings::instance()->editor;

        return $this->makePartial($editor);
    }

    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->model->{$this->fieldName};

        $this->vars['width'] = (empty(Settings::instance()->editor_width)) ? '100%' : Settings::instance()->editor_width;
        $this->vars['height'] = (empty(Settings::instance()->editor_height)) ? '500px' : Settings::instance()->editor_height;
        $this->vars['lang'] = App::getLocale();

        $this->vars['toolbar_ckeditor'] = (empty(Settings::instance()->toolbar_ckeditor)) ? "['Undo', 'Redo'], ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'], ['Format', 'FontSize'], ['ShowBlocks', 'SelectAll', 'RemoveFormat'], ['Source'], ['Maximize'], '/', ['Bold', 'Italic', 'Underline', 'Strike'], ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'], ['BulletedList', 'NumberedList', 'Outdent', 'Indent'], ['TextColor', 'BGColor'], ['Link', 'Unlink', 'Anchor'], ['Image', 'Table', 'oembed', 'SpecialChar', 'OcMediaManager']" : Settings::instance()->toolbar_ckeditor;

    }

    public function loadAssets()
    {
        $locale = App::getLocale();

        $this->addJs('/plugins/teb/wysiwygeditors/formwidgets/editor/assets/ckeditor/ckeditor.js');
        $this->addJs('/plugins/teb/wysiwygeditors/formwidgets/editor/assets/ckeditor/adapters/jquery.js');

        if ($locale != 'en' && File::exists('plugins/teb/wysiwygeditors/formwidgets/editor/assets/ckeditor/lang/'.$locale.'.js')) {
            $this->addJs('/plugins/teb/wysiwygeditors/formwidgets/editor/assets/ckeditor/lang/'.$locale.'.js');
        }
    }
}
