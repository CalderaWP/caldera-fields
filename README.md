CalderaWP Fields
=======================
Form Fields Renderer and Manager

Using it
---------
```PHP

$fields = new \calderawp\input\fields();

$field_config = array(
	'lable' => 'Username',
	'required' => true,
);

echo $fields->render_field( 'text', $field_config );

```

