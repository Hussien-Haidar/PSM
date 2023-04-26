<?php include('session.php'); ?>
<?php include('header.php'); ?>
<head>
    <style>
        .canvasjs-chart-credit{display:none;}
    </style>
    <!-- JavaScript Libraires for drawing Piecharts -->
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <?php
  $dataPoints = array(
array("label" => "Jan", "y" => 40),
    array("label" => "Feb", "y" => 24,), //"indexLabel"=> "Lowest"
    array("label" => "Mar", "y" => 16),
    array("label" => "Apr", "y" => 30),
    array("label" => "May", "y" => 20,),
     array("label" => "Jun", "y" => 29,), 
      array("label" => "Jul", "y" => 24,), 
       array("label" => "Aug", "y" => 33,), 
        array("label" => "Sep", "y" => 5,), 
         array("label" => "Oct", "y" => 10,), 
          array("label" => "Nov", "y" => 40,), 
           array("label" => "Dec", "y" => 50,), 
    //array("label" => date('d-m-y', strtotime($fifth)), "y" => 20,), //"indexLabel"=> "Highest"
);
  ?>
</head>
    <body >
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar_dashboard.php'); ?>
             

 <div class="span9" id="content">
						<div class="row-fluid"></div>
						
                    <div class="row-fluid">
            
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">BUDGET STATISTICS (الاحصائيات)</div>
                            </div>
                            <div class="block-content collapse in">
                                  <center><div>
                <span class='btn btn-success' style="color:white;font-weight:bold;font-size:30px;height:100px;display: flex;
  justify-content: center;
  align-items: center;">Current Overall Budget:  + 34,000 $</span>
               
              </div></center><br><br>
							        <div class="span12">
	
      <div id="pieContainer" class="span4" style="height:300px; "></div>
   <div id="pieContainer2" class="span4" style="height:300px; "></div>
   <div id="pieContainer3" class="span4" style="height:300px; "></div>
 <div id="pieContainer4" class="span4" style="height:300px; "></div>
   <div id="pieContainer5" class="span4" style="height:300px; "></div>
   <div id="pieContainer6" class="span4" style="height:300px; "></div>
   
 </div>
 <div class="span12">
     <div id="chartContainer" style="height:500px; "></div>
 </div>
 </div>
 </div>
 </div>
 </div>
                                </div>
                            </div>
                        
		<?php include('footer.php'); ?>
  
		<?php include('script.php'); ?>
        <script>
            window.onload = function () {

                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: false,
                    theme: "light", // "light1", "light2", "dark1", "dark2"
                    title: {
                        text: "Monthly Budget (Profits/Losses)"
                    },
                    axisX: {
                        interval: 1,
                        intervalType: "day"
                    },
                    axisY: {
                        interval: 10,
                        intervalType: "number"
                    },
                    data: [{
                            type: "column", //change type to bar, line, area, pie, etc
                            indexLabel: "{y}", //Shows y value on all Data Points
                            indexLabelFontColor: "#5A5757",
                            indexLabelPlacement: "outside",
showInLegend:true, 
		legendMarkerColor: "grey",
		legendText: "02-08-21 = 02-08-2021",
                            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                        }]
                });
                
 var expincChart = new CanvasJS.Chart("pieContainer", {
	animationEnabled: true,
	title: {
		text: "Month Expenses vs Incomes"
	},
	data: [{
	    
		type: "pie",
	
		yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
		{y: <?php echo "5" ?>, label: "Expenses",color:"#B22222"},
			{y: <?php echo "4" ?>, label: "Incomes",color:"OliveDrab"},

		]
	},
	    
	
	],
});
var ordChart = new CanvasJS.Chart("pieContainer2", {
	animationEnabled: true,
	title: {
		text: "Total Order Profits Over Cities"
	},
	data: [{
		type: "pie",
		startAngle: 240,
			yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo "40" ?>, label: "Beirut"},
			{y: <?php echo "9" ?>, label: "Zahle"},
			{y: <?php echo "2" ?>, label: "Nabatieh"},
		
		]
	}]
});
 var catChart = new CanvasJS.Chart("pieContainer3", {
	animationEnabled: true,
	title: {
		text: "Expenses Over Categories"
	},
	data: [{
		type: "pie",
		startAngle: 120,
		yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo "4" ?>, label: "Electricity"},
			{y: <?php echo "16" ?>, label: "Fuel"},
			{y: <?php echo "9" ?>, label: "Desks"},
			{y: <?php echo "50" ?>, label: "Papers"},
			{y: <?php echo "2" ?>, label: "Water"},
			{y: <?php echo "3" ?>, label: "Rent"}
	
		]
	}]
});

 var incatChart = new CanvasJS.Chart("pieContainer4", {
	animationEnabled: true,
	title: {
		text: "Incomes Over Categories"
	},
	data: [{
		type: "pie",
		startAngle: 120,
		yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo "4" ?>, label: "Electricity"},
			{y: <?php echo "16" ?>, label: "Fuel"},
			{y: <?php echo "9" ?>, label: "Desks"},
			{y: <?php echo "50" ?>, label: "Papers"},
			{y: <?php echo "2" ?>, label: "Water"},
			{y: <?php echo "3" ?>, label: "Rent"}
	
		]
	}]
});
 var budChart = new CanvasJS.Chart("pieContainer5", {
	animationEnabled: true,
	title: {
		text: "Current Budget"
	},
	data: [{
		type: "pie",
		startAngle: 120,
		yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo "4" ?>, label: "In"},
			{y: <?php echo "16" ?>, label: "Out"}
	
		]
	}]
});
 var annualChart = new CanvasJS.Chart("pieContainer6", {
	animationEnabled: true,
	title: {
		text: "Annual Expenses vs Incomes"
	},
	data: [{
		type: "pie",
		startAngle: 120,
		yValueFormatString: "##0\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
		{y: <?php echo "99" ?>, label: "Expenses",color:"#B22222"},
			{y: <?php echo "44" ?>, label: "Incomes",color:"OliveDrab"},
	
		]
	}]
});
expincChart.render();
ordChart.render();
catChart.render();
incatChart.render();
budChart.render();
annualChart.render();
chart.render();

            }
        </script>
    </body>	
</html>