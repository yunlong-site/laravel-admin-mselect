<?php

namespace YunLong\MSelect;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Form\Field\MultipleSelect;
use Illuminate\Support\Str;

class MSelect extends MultipleSelect
{
    protected $view = 'laravel-admin-mselect::mselect';
    /**
     * Load options for other select on change.
     *
     * @param string $field
     * @param string $sourceUrl
     * @param string $idField
     * @param string $textField
     *
     * @return $this
     */
    public function load($field, $sourceUrl, $idField = 'id', $textField = 'text', bool $allowClear = true)
    {
        if (Str::contains($field, '.')) {
            $field = $this->formatName($field);
            $class = str_replace(['[', ']'], '_', $field);
        } else {
            $class = $field;
        }

        $placeholder = json_encode([
            'id'   => '',
            'text' => trans('admin.choose'),
        ]);

        $strAllowClear = var_export($allowClear, true);

        $script = <<<EOT
$(document).off('change', "{$this->getElementClassSelector()}");
$(document).on('change', "{$this->getElementClassSelector()}", function () {
    var ids = '';
    $(this).find("option:selected").each(function () {
         ids = ids + this.value + ','
    })
    var target = $(this).closest('.fields-group').find(".$class");
    $.get("$sourceUrl",{q : ids}, function (data) {
        target.find("option").remove();
        $(target).select2({
            placeholder: $placeholder,
            allowClear: $strAllowClear,
            data: $.map(data, function (d) {
                d.id = d.$idField;
                d.text = d.$textField;
                return d;
            })
        });
        if (target.data('value')) {
            $(target).val(target.data('value'));
        }
        $(target).trigger('change');
    });
});
EOT;

        Admin::script($script);

        return $this;
    }
}
