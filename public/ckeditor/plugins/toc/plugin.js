function ChangeToSlug(input_text)
            {
                var slug;
                //Đổi chữ hoa thành chữ thường
                slug = input_text.toLowerCase();
 
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, ''); 

                return slug;
            }

(function()
	{
		CKEDITOR.plugins.add( 'toc', {

			// Register the icons. They must match command names.
			icons: 'toc',
			lang: ['de','en','vn'],
			// The plugin initialization logic goes inside this method.
			init: function( editor ) {

				// Define the editor command that inserts a timestamp.
				editor.addCommand( 'insertToc', {
		
					allowedContent: '*[id,name,class]{margin-left}',
					// Define the function that will be fired when the command is executed.
					exec: function( editor )
					{
						//remove already exisiting tocs...
						var tocElements = editor.document.$.getElementsByName("tableOfContents");
						for (var j = tocElements.length; j > 0; j--) 
						{
							var oldid = tocElements[j-1].getAttribute("id").toString();
							editor.document.getById(oldid).remove();
						}
						//find all headings
						var list = [],
						nodes = editor.editable().find('h1,h2,h3,h4,h5,h6,');

						if ( nodes.count() == 0 )
						{
							alert( editor.lang.toc.notitles );
							return;
						}
						//iterate over headings
						var tocItems = "";
						for ( var i = 0 ; i < nodes.count() ; i++ )
						{
							var node = nodes.getItem(i),
								//level can be used for indenting. it contains a number between 0 (h1) and 5 (h6).
								level = parseInt( node.getName().substr( 1 ) ) - 1;

							var text = new CKEDITOR.dom.text( CKEDITOR.tools.trim( node.getText() ), editor.document);

							var id="";
							//check if heading has id
							if(node.hasAttribute("id")) { id = node.getAttribute("id").toString(); }
							//if no id, create an id based on the text
							else 
							{
								//id = text.getText().replace(/[^A-Za-z0-9\_\-]/g, "+");
								id = ChangeToSlug(text.getText());
								node.setAttribute( 'id', id.toString() );
							}
							//create name-attribute based on id
							node.setAttribute( 'name', id.toString() );
				
							//build toc entries as divs
							tocItems = tocItems + '<div dataStt="'+level+'" style="padding-left:'+level*20+'px" id="' + id.toString() + '-toc" name="tableOfContents">' + '<a href="#' + id.toString() + '">' + text.getText().toString() + '</a></div>';
						}

						//output toc
						var tocNode = '<div class="tableOfContents-wapper"> <h3 name="tableOfContents" id="main-toc">' + editor.lang.toc.ToC + '</h3> <div class="inner-toc">' + tocItems + '</div></div>';
						editor.insertHtml(tocNode);
					}
				});

				// Create the toolbar button that executes the above command.
				editor.ui.addButton( 'toc', {
					label: editor.lang.toc.tooltip,
					command: 'insertToc',
					icon: this.path + 'icons/toc.png',
   		         toolbar: 'links'
				});
			}
		}
	)
})
();
