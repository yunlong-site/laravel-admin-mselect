## 基于 laravel-admin 的 multiSelect 表单组件而拓展的多选联动框
### 安装
`composer require yunlong/mselect`
### 使用
`$form->mselect('column')->options([0=>'option1',1=>'option2'])->load('loadColumn','/yourPath');
$form->select('loadColumn');`