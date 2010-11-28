/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {
  if (!$.browser.webkit && !$.browser.mozilla) {
    browser_error(); 
 }
 $("a[title]").tooltip({
		tip: '.tooltipview',
		effect: 'fade',
		fadeOutSpeed: 100,
		predelay: 400,
		position: "bottom right"
		
	});
$(".downloadbox[title]").tooltip({
		tip: '.tooltipview',
		effect: 'fade',
		fadeOutSpeed: 100,
		predelay: 400,
		position: "bottom right",
		offset: [-60, -80]
	});

pagination();
 $(".downloadbox").colorbox({width:"50%", height:"60%", iframe:true});
 $(".scrollable").scrollable({});
});
var url=window.location.protocol+"//"+window.location.hostname+"/";
function blog_comments(id)
{
    $(".blog_comments").load(url+"blog/comments",{'id': id});
}
function blog_get_text_editor()
{
    var oEditor = CKEDITOR.instances.editor1;
        alert( oEditor.getData() );
    //alert($('.blog_comments_editor').ckeditor(function(){$(this).getData();}));
}
function blog_add_editor()
{
	$('.blog_comments_editor').ckeditor(
    {
        toolbar:
        [
            ['Source','-','Save','NewPage','Preview','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['BidiLtr', 'BidiRtl'],
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],'/',
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
            ['TextColor','BGColor'],'/',
            ['Styles','Format','Font','FontSize'],
        ]
    });
    
}
function pagination()
{
    $('.ajax_pag a').click(function(event){
   // получаем содержимое ссылки
   var link = $(this).attr('href');
   // отменяем действие по умолчанию
   event.preventDefault();
   // посылаем ajax-запрос по полученной ссылке
   $('#ajax_content').load(link,function(){
       pagination();
   });
   });
}


function browser_error()
{
    $('body').append('<div class="over"><div class="over_msg">'+
        '<a href="http://www.google.com/chrome" target="_blank"><img width="128" height="128" src="'+url+'themes/system/images/Chrome_128_nq8.png"/></a>'+
        '<a href="http://www.mozilla.com/" target="_blank"><img width="128" height="128" src="'+url+'themes/system/images/Firefox-128-nq8.png"/></a>'+
        '<a href="http://www.apple.com/safari/download/" target="_blank"><img width="128" height="128" src="'+url+'themes/system/images/Safari-128-nq8.png"/></a>'+
       '</div></div>');
    $('.over').overlay({
        load:true,
        mask: {
		color: 'red',
		loadSpeed: 200,
		opacity: 0.9
	},
        closeOnClick:false,
        closeOnEsc:false
    });
}
