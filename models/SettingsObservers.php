<?php namespace Teb\WysiwygEditors\models;

use Illuminate\Support\Facades\File;

class SettingsObservers
{
  public function saved($model)
  {
    //error_log(print_r($model, true));
    // 1. 데이터 -> 문자열
    $decoded_model = json_decode($model);
    $decoded_value = json_decode($decoded_model->value);

    // 2. 문자열 -> 파일
    File::put(base_path().'/plugins/teb/wysiwygeditors/formwidgets/editor/assets/ckeditor/plugins/templates/templates/default.js', $decoded_value->template_as_wysiwyg);
  }
}