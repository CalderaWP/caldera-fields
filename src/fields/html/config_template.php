<textarea id="html-template-code" data-mode="text/html" name="code">{{code}}</textarea>
{{#script}}
	var this_editor = cf_init_editor('html-template-code');
	setTimeout( function(){
		this_editor.refresh();
		this_editor.focus();
	}, 100 );
{{/script}}
