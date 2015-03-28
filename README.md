CalderaWP Fields
=======================
Form Fields Renderer and Manager

Using it
---------
```PHP
$fields = new \calderawp\input\fields();
$text_field = array(
	'lable' => 'Username',
	'required' => true,
	'type'	=> 'text',
);

echo $fields->render_field( $text_field );

```

