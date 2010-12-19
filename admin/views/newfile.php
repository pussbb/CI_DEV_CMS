<div id="filetree"></div>
<script src="<?=  base_url()?>system/js/jqueryFileTree/jqueryFileTree.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=  base_url()?>system/js/jqueryFileTree/jqueryFileTree.css"/>
<script type="text/javascript" >
$('#filetree').fileTree({ root: '../../../../public/'
    ,script: '<?=  base_url()?>system/js/jqueryFileTree/connectors/jqueryFileTree.php'}, function(file) {
    
        alert(file);
    });

</script>