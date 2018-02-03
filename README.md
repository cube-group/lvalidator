# LValidator是一个简单的验证类
支持批量验证表单数据、自定义错误信息，简化大量的验证判断代码，使代码变得加简洁优雅！

##快速使用
```$xslt
$data = [
    'name' => 'chenqionghe',
    'age' => '十八',
    'email' => 'abc',
    'money' => "abc",
    'address' => 'beijing',
    'sex' => 'man',
    'lang' => 'php',
];
$validator = new  LValidator($data);
$validator->rules([
    ['required', 'name'],
    ['email', 'email'],
    ['numeric', 'age'],
    ['length', 'address', ">=", 20],
    ['in', 'sex', ['男','女']],
    ['notIn', 'lang', ['php', 'go','java']],
]);
//验证触发方法
if (!$validator->validate()) {
    var_dump($validator->errors());//打印所有错误(返回数组)
    var_dump($validator->errorString());//打印错误字符串
}
```
输出
```$xslt
array (size=5)
  'email' => 
    array (size=1)
      0 => string 'email是无效邮箱, 非法值abc' (length=34)
  'age' => 
    array (size=1)
      0 => string 'age只能是数字' (length=18)
  'address' => 
    array (size=1)
      0 => string 'address长度必须>=20' (length=23)
  'sex' => 
    array (size=1)
      0 => string 'sex必须在['男', '女']范围内' (length=35)
  'lang' => 
    array (size=1)
      0 => string 'lang不能在范围['php', 'go', 'java'], 非法值php' (length=54)
string 'email是无效邮箱, 非法值abc|age只能是数字|address长度必须>=20|sex必须在['男', '女']范围内|lang不能在范围['php', 'go', 'java'], 非法值php' 
```


##快速验证单个规则 
```
LValidator::isUrl("http://www.baidu.com"));
LValidator::isEmail("abc@abc.com"));
LValidator::isIP("localhost"));
LValidator::isAlpha('abc'));
LValidator::isAlphaNum('123abc'));
LValidator::isSlug('123abc_'));
LValidator::isDate('2010'));
LValidator::isMobile('123456'));
LValidator::isTel('123456'));
```

##使用demo1 通过rule或rules添加验证规则
构造函数传入验证数据
```
$validator = new  LValidator(['name' => '', 'email' => 'abc', 'age' => '十八']);
$validator = new LValidator([]);
$validator->rule(['email', 'email']);
$validator->rules([
    ['required', 'name'],
    ['integer', 'age'],
]);
if ($validator->validate()) {
    //验证通过
} else {
    var_dump($validator->errors());//打印失败信息
    var_dump($validator->errorString());//打印错误信息字符串,
}
```
输出
```
array (size=3)
  'email' => 
    array (size=1)
      0 => string 'Email是无效邮箱, 非法值abc' (length=34)
  'name' => 
    array (size=1)
      0 => string 'Name不能为空' (length=16)
  'age' => 
    array (size=1)
      0 => string 'Age只能是整数(0-9)' (length=23)
```


##使用demo2 自定义错误信息

设置规则的的message属性
{field}最终替换为字段键, {value}替换为字段值
```        
$data = ['name' => '', 'age' => 'a',];
$label = ['name' => '姓名'];
$val = new LValidator($data, $label);
$val->rules([
    ['required', "name", 'message' => "姓名不能为空！"],
    ['numeric', "age", 'message' => '{fields}不能为空，年龄必须是数字，非法值{value}！'],
]);
if (!$val->validate()) {
    var_dump($val->errors());
    var_dump($val->errorString());
}
```
输出
```
array (size=2)
  'name' => 
    array (size=1)
      0 => string '姓名不能为空！' (length=21)
  'age' => 
    array (size=1)
      0 => string '{fields}不能为空，年龄必须是数字，非法值a！' 
姓名不能为空！|{fields}不能为空，年龄必须是数字，非法值a！'
```

##使用demo3 设置字段标签
设置提示字段标签, 如name显示为名字, 通过构造方法传字段标签数组
```
$validator = new  LValidator(
    ['name' => '', 'email' => 'abc', 'age' => '十八'],//验证数据
    ['name' => '用户名', 'email' => '我的邮箱', 'age' => '年龄']//字段标签
);
$validator->rules([
    ['required', 'name'],
    ['integer', 'age'],
    ['email', 'email']
]);
if ($validator->validate()) {
    //验证通过
} else {
    var_dump($validator->errors());//打印失败信息
}
```
输出
```
array (size=3)
  'name' => 
    array (size=1)
      0 => string '用户名不能为空' (length=21)
  'age' => 
    array (size=1)
      0 => string '年龄只能是整数(0-9)' (length=26)
  'email' => 
    array (size=1)
      0 => string '我的邮箱是无效邮箱, 非法值abc' (length=41)
string '用户名不能为空|年龄只能是整数(0-9)|我的邮箱是无效邮箱, 非法值abc' (length=90)
```

##以下是目前支持的验证规则
* required     必传
* numeric      只能是数字
* alpha        只能包括英文字母(a-z)
* alphaNum     只能包括英文字母(a-z)和数字(0-9)
* slug         只能包括英文字母(a-z)、数字(0-9)、破折号和下划线
* bool         只能是true或false
* contains     必须包含指定字符串
* compare      对比验证
* length       字符串长度对比验证(基于compare验证)
* date         只能是日期格式
* dateAfter    日期必须在指定日期之后
* dateBefore   日期必须在指定日期之前
* same         必须和指定字段值相同
* diff         必须和指定字段值不同
* in           必须在指定范围
* notIn        必须不在指定范围
* numeric      必须是数字
* ip           必须是IP地址
* url          必须是URL地址
* tel          验证大陆电话
* carPlate     验证车牌号
* bankCard     验证银行卡号
* length       字符长度验证
* regex        匹配指定正则表达式
* func         使用函数或方法验证
* closure      使用闭包验证
* json         验证json格式

##验证规则使用Demo
- required(验证必传)
设置skipEmpty属性为1可以跳过空验证，但是字段必传
```
$data = ['name' => '','name_isset' => ''];
$val = new LValidator($data);
$val->rules([
    ['required', "name", 'message' => '姓名不能为空',],
    ['required', "name_isset", 'message' => 'name_isset字段必须有，可以为空', 'skipEmpty' => false],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- json(验证json格式)
```$xslt
$data = ['json1' => 'abcdef', 'mobile2' => '{"name":"chenqionghe","age":18}'];
$val = new LValidator($data);
$val->rules([
    ['json', "json1"],
    ['json', "json2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- url(验证URL地址)
```$xslt
$data = ['url1' => 'abcdef', 'url2' => 'http://www.baidu.com'];
$val = new LValidator($data);
$val->rules([
    ['url', "url1"],
    ['url', "url2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}

```
- ip(验证IP地址)
 ```$xslt
$data = ['ip1' => 'abcdef', 'ip2' => '127.0.0.1'];
$val = new LValidator($data);
$val->rules([
    ['ip', "ip1"],
    ['ip', "ip2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- email(验证邮箱)
```$xslt
$data = ['email1' => 'abcdef', 'email2' => 'chenqionghe@sina.com'];
$val = new LValidator($data);
$val->rules([
    ['email', "email1"],
    ['email', "email2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- numeric(验证数字) 
```$xslt
$data = ['number1' => '123', 'number2' => 'abcd'];
$val = new LValidator($data);
$val->rules([
    ['numeric', "number1"],
    ['numeric', "number2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- alpha(验证英文字母)
```
$data = ['name1' => '123', 'name2' => 'abcd'];
$val = new LValidator($data);
$val->rules([
    ['alpha', "name1"],
    ['alpha', "name2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- alphaNum(验证英文字母+数字)
```
$data = ['name1' => '123abc___', 'name2' => '123abc'];
$val = new LValidator($data);
$val->rules([
    ['alphaNum', "name1"],
    ['alphaNum', "name2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- slug(英文字母+数字+破折号+下划线)
```
$data = ['name1' => '123abc___', 'name2' => '123abc...'];
$val = new LValidator($data);
$val->rules([
    ['slug', "name1"],
    ['slug', "name2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- bool(验证必须是布尔值)
```$xslt
$data = ['eq' => 'abcdef', 'mobile2' => false];
$val = new LValidator($data);
$val->rules([
    ['bool', "bool1"],
    ['bool', "bool2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- date(验证必须是时间日期格式)
```$xslt
$data = ['date1' => '123abc___', 'date2' => '20180201', 'date3' => '20180201 12:00'];
$val = new LValidator($data);
$val->rules([
    ['date', "date1"],
    ['date', "date2"],
    ['date', "date3"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- tel(验证大陆电话)
```$xslt
$data = ['tel1' => '1234abcd', 'tel2' => '089862222222'];
$val = new LValidator($data);
$val->rules([
    ['tel', "tel1"],
    ['tel', "tel2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- mobile(验证手机号)
```$xslt
$data = ['mobile1' => '1234abcd', 'mobile2' => '13188888888'];
$val = new LValidator($data);
$val->rules([
    ['mobile', "mobile1"],
    ['mobile', "mobile2"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- same(验证字段必须和另一个字段值相同)
```
$data = ['name1' => 'abc', 'name2' => 'abcd'];
$val = new LValidator($data);
$val->rules([
    ['same', "name1", 'name2'],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}

```
- diff(验证字段必须和另一个字段值不同)
```
$data = ['name1' => 'abc', 'name2' => 'abc'];
$val = new LValidator($data);
$val->rules([
    ['diff', "name1", 'name2'],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}

```
- compare(对比验证(支持> >= < <= == === != !===)
```
$data = ['age' => 18];
$val = new LValidator($data);
$val->rules([
    ['compare', 'age', ">", 18],
    ['compare', 'age', ">=", 18],
    ['compare', 'age', "<", 18],
    ['compare', 'age', "<=", 18],
    ['compare', 'age', "==", 18],
    ['compare', 'age', "===", 18],
    ['compare', 'age', "!=", 18],
    ['compare', 'age', "!==", 18],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- length(字符串长度对比验证,基于compare验证)
```
$data = ['name'=>'a'];
$val = new LValidator($data);
$val->rules([
    ['length', 'name', ">", 18],//name长度 > 18
    ['length', 'name', ">=", 18],//name长度 >= 18
    ['length', 'name', "<", 18],//name长度 < 18
    ['length', 'name', "<=", 18],//name长度 <= 18
    ['length', 'name', "==", 18],//name长度 == 18
    ['length', 'name', "===", 18],//name长度 === 18
    ['length', 'name', "!=", 18],//name长度 != 18
    ['length', 'name', "!==", 18],//name长度 !== 18
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- contains(必须包含acb)
```
$data = ['name1' => "abcd", 'name2' => 'cqhabc'];
$val = new LValidator($data);
$val->rules([
    ['contains', ['name1', 'name2'], "cqh"],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- in(必须在范围[1,2,3])
```
$data = ['name' => "abc", 'lang' => 'abcd'];
$val = new LValidator($data);
$val->rules([
    ['in', "name", ['jack', 'rose', 'james']],
    ['in', "lang", ['php', 'java', 'go']],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- notIn(必须不在范围[1,2,3])
```
$data = ['name' => "abc", 'lang' => 'php'];
$val = new LValidator($data);
$val->rules([
    ['notIn', "name", ['jack', 'rose', 'james']],
    ['notIn', "lang", ['php', 'java', 'go']],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- regex(正则验证)
```
$data = ['name1' => "abc", 'name2' => 'cqhabc'];
$val = new LValidator($data);
$val->rules([
    ['regex', ['name1', 'name2'], '/^cqh.*/'],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```

- func(函数或方法验证)
```
$data = ['name' => "abc"];
$val = new LValidator($data);
$val->rules([
    ['func', 'name', 'is_array'],
    ['func', 'name', [\libs\Utils\Arrays::class, 'isMultidim']],
]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```
- 闭包验证(验证名字必须是helloWorld)
```
$data = ['name1' => "abc"];
$val = new LValidator($data);
$val->rules([
    [function ($field, $value) {
        return $value == 'helloWorld';
    }, 'name1', 'message' => '名字不是helloWorld'],

]);
if (!$val->validate()) {
    var_dump($val->errorString());
}
```

#其他方法
##设置字段标签
- 通过lables批量方法追加, 如果已经在值, 将覆盖旧值
```
$validator->labels([
    'email' => '邮箱地址',
    'alphaTest' => '数字测试',
    'boolTest' => '布尔测试',
]);
```
- 调用rule后通过label方法添加
```
$validator->rule(['required', 'testRequired2'])->message("{field}不能为空(自定义格式)")->label('自定义标签testRequired2');

```

















