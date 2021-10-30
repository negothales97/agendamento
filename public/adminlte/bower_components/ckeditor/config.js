
CKEDITOR.editorConfig = function( config ) {
	
	config.language = 'pt-BR';
	config.toolbarGroups = [
		{ name: 'links' },
		{ name: 'document',	   groups: [  'document', 'doctools' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles', items: [] },
	];

	config.removeButtons = 'Underline,Subscript,Superscript';
	config.extraPlugins = 'font,richcombo';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
};
