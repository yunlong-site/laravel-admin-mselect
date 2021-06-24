# 基于 laravel-admin 的 multipleSelect 表单组件而拓展的多选联动框
## Installation
```
composer require yunlong/mselect
```
## Usage
```
$form->mselect('column')->options([0=>'option1',1=>'option2'])->load('loadColumn','/yourPath');

$form->select('loadColumn');
```
## License
Licensed under The [MIT License (MIT)](./LICENSE).