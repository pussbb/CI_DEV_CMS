<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<meta name="keywords" content="<?= $meta ?>" />
<meta name="description" content="<?= $metadescr ?>" />
<link href="<?php echo base_url() . $this->config->item('pathtemplate'); ?>style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/admin_system.css';?>"/>
<?= $_styles ?>
<?= $_scripts ?>
<script type="text/javascript" src="<?php echo base_url()?>system/js/highcharts/highcharts.js"></script>
<script type="text/javascript">


			Highcharts.visualize = function(table, options) {
				// the categories
				options.xAxis.categories = [];
				$('tbody th', table).each( function(i) {
					options.xAxis.categories.push(this.innerHTML);
				});

				// the data series
				options.series = [];
				$('tr', table).each( function(i) {
					var tr = this;
					$('th, td', tr).each( function(j) {
						if (j > 0) { // skip first column
							if (i == 0) { // get the name and init the series
								options.series[j - 1] = {
									name: this.innerHTML,
									data: []
								};
							} else { // add values
								options.series[j - 1].data.push(parseFloat(this.innerHTML));
							}
						}
					});
				});

				var chart = new Highcharts.Chart(options);
			}

			// On document ready, call visualize on the datatable.
			$(document).ready(function() {
				var table = document.getElementById('datatable'),
				options = {
					   chart: {
					      renderTo: 'container',
					      defaultSeriesType: 'column',
                                              margin: [ 50, 50, 100, 80]
					   },
					   title: {
					      text: 'Application Satistic'
					   },
                                           xAxis: {
                                               labels: {
							rotation: -45,
							align: 'right',
							style: {
								 font: 'normal 13px Verdana, sans-serif'
							}
						}
					   },
					   yAxis: {
					      title: {
					         text: 'Downloads'
					      }
					   },
					   tooltip: {
					      formatter: function() {
					         return '<b>'+ this.series.name +'</b><br/>'+
					            this.y +' '+ this.x.toLowerCase();
					      }
					   }
					};


				Highcharts.visualize(table, options);
			});

		</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="<?= base_url()?>admin/"><?= $this->config->item('site_name');?></a></h1>
			- <h2> || Administrator Area ||</h2>
		</div>
		<!-- end #logo -->
		<div id="menu">
			<ul>
				<li class="first"><a href="#" onclick="load('app');"><?= $this->lang->line('apps'); ?></a></li>
				<li><a href="#" onclick="load('blog');"><?= $this->lang->line('blog'); ?></a></li>
				<li><a href="#" onclick="load('news');"><?=lang('news')?></a></li>
				<li><a href="#" onclick="load('users');"><?=lang('users')?></a></li>
			</ul>
		</div>
		<!-- end #menu -->
	</div>
	<!-- end #header -->
	<div id="page">
         
				<div id="content">
                                   <div class="post"><div id="container" style="width: 900px; height: 500px; margin: 0 auto"></div>
 <?=$content?>
					
						
					
				<!--- <div class="post"><?=$futures?>---></div>
				</div>
				 
				<!-- end #content -->
				<div class="sidebar">
				 
				<div id="sidebar">
					<ul><?=$sidemenu;?>
                                        </ul>
				</div>

				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
		
	</div>
	<!-- end #page -->
	<div id="footer">
		<p>Copyright (c) 2010</p>
	</div>
	<!-- end #footer -->
</div>
<!-- end #wrapper -->
</body>
</html>
