/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
   config.filebrowserBrowseUrl = '/system/js/ckeditor/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = '/system/js/ckeditor/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = '/system/js/ckeditor/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = '/system/js/ckeditor/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = '/system/js/ckeditor/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = '/system/js/ckeditor/kcfinder/upload.php?type=flash';
};
