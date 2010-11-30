<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>CKFinder - Sample - Standalone</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	
        <script type="text/javascript" src="<?=  site_url('system/js/ckfinder/')?>/ckfinder.js"></script>
</head>
<body>

    
	<hr />


	<p style="padding-left: 30px; padding-right: 30px;">
		<script type="text/javascript">

			// This is a sample function which is called when a file is selected in CKFinder.
			function showFileInfo( fileUrl, data )
			{
				var msg = 'The selected URL is: <a href="' + fileUrl + '">' + fileUrl + '</a><br /><br />';
				// Display additional information available in the "data" object.
				// For example, the size of a file (in KB) is available in the data["fileSize"] variable.
				if ( fileUrl != data['fileUrl'] )
					msg += '<b>File url:</b> ' + data['fileUrl'] + '<br />';
				msg += '<b>File size:</b> ' + data['fileSize'] + 'KB<br />';
				msg += '<b>Last modifed:</b> ' + data['fileDate'];

				// this = CKFinderAPI object
				this.openMsgDialog( "Selected file", msg );
			}

			// You can use the "CKFinder" class to render CKFinder in a page:
			var finder = new CKFinder();
			// The path for the installation of CKFinder (default = "/ckfinder/").
			finder.basePath = '<?=  site_url('system/js/ckfinder/')?>';
			// This is a sample function which is called when a file is selected in CKFinder.
			finder.enabled   = "true";
                        finder.selectActionFunction = showFileInfo;
			finder.create();

			// It can also be done in a single line, calling the "static"
			// create( basePath, width, height, selectActionFunction ) function:
			// CKFinder.create( '../../', null, null, showFileInfo );

			// The "create" function can also accept an object as the only argument.
			// CKFinder.create( { basePath : '../../', selectActionFunction : showFileInfo } );

		</script>
	</p>
</body>
</html>
