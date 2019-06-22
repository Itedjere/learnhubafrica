
		/*
		tinymce.init({
			selector: "textarea",  // change this value according to your html
			
			theme: 'modern',
			
			plugins: ['advlist autoresize autosave bbcode autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker', 'noneditable searchreplace wordcount visualblocks visualchars code codesample colorpicker fullpage fullscreen insertdatetime media nonbreaking', 'tabfocus textpattern save table contextmenu directionality emoticons template paste textcolor example example_dependency importcss layer legacyoutput'],
			
			toolbar: ['newdocument | insertfile undo redo | styleselect | bold italic underline strikethrough | link image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent subscript superscript | fontselect fontsizeselect | print preview media fullpage | forecolor backcolor emoticons'],
			
			//image_list: [{title: 'My image 1', value: 'http://localhost/epmmi/images/1_b.jpg'}], 
			//image_caption: true,
			image_prepend_url: "http://localhost/epmmi/images/"
		});
		
		
		
		BASIC EXAMPLE FROM THE WEBSITE
		
		tinymce.init({
		  selector: 'textarea',
		  height: 500,
		  plugins: [
			'advlist autolink lists link image charmap print preview anchor',
			'searchreplace visualblocks code fullscreen',
			'insertdatetime media table contextmenu paste code'
		  ],
		  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		  content_css: [
			'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
			'//www.tinymce.com/css/codepen.min.css'
		  ]
		});
		
		
		
		
		
		FULL FEATURED EXAMPLE FROM THE WEBSITE
		*/
		tinymce.init({
		  selector: '#textarea',
		  height: 200,
		  theme: 'modern',
		  plugins: [
			'advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern'
		  ],
		  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		  toolbar2: 'print preview media | forecolor backcolor emoticons',
		  image_advtab: true,
		  templates: [
			{ title: 'Test template 1', content: 'Test 1' },
			{ title: 'Test template 2', content: 'Test 2' }
		  ],
		  content_css: [
			'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
			'//www.tinymce.com/css/codepen.min.css'
		  ]
		 });
		 
		 
		 /*
		 CLASSIC EXAMPLE FROM THE WEBSITE
		 tinymce.init({
		  selector: "textarea",
		  height: 500,
		  plugins: [
			"advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
			"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
		  ],

		  toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
		  toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
		  toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

		  menubar: false,
		  toolbar_items_size: 'small',

		  style_formats: [{
			title: 'Bold text',
			inline: 'b'
		  }, {
			title: 'Red text',
			inline: 'span',
			styles: {
			  color: '#ff0000'
			}
		  }, {
			title: 'Red header',
			block: 'h1',
			styles: {
			  color: '#ff0000'
			}
		  }, {
			title: 'Example 1',
			inline: 'span',
			classes: 'example1'
		  }, {
			title: 'Example 2',
			inline: 'span',
			classes: 'example2'
		  }, {
			title: 'Table styles'
		  }, {
			title: 'Table row 1',
			selector: 'tr',
			classes: 'tablerow1'
		  }],

		  templates: [{
			title: 'Test template 1',
			content: 'Test 1'
		  }, {
			title: 'Test template 2',
			content: 'Test 2'
		  }],
		  content_css: [
			'//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
			'//www.tinymce.com/css/codepen.min.css'
		  ]
		});
		*/