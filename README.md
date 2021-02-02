# smsbao-sdk

短信宝 SDK

### 安装

```cmd
    composer require hicolin/smsbao
```

### 使用
```php
    $account = "xxx";
    $password = "xxx";
    $phone = "xxx";
    $content = "xxx";
    
    $smsbao = new Hicolin\Smsbao\Smsbao($account, $password);
    $result = $smsbao->send($phone, $content);
```
