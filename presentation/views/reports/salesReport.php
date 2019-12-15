<!-- 
Project name: CST-236 ecommerce store app Milestone6
    Version:   1.0
Module name:  salesReport.php
    Version:   1.0
Author:		 Marc Teixeira
Date:         12/14/2019
Description: This file helps to generate a new sales report for viewing by an admin user
 -->

<!-- header -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/utility/_header.php'; 
      include $_SERVER['DOCUMENT_ROOT'] . '/presentation/handlers/salesReportHandler.php';
?>		

<div class="message">
	<!-- Home page message -->
	<h2><?php if($_SESSION['User_ID'] != -1){ echo $pageTitle; } else { header("Location: /index.php"); }?></h2>
	<!-- warning message if any -->
	<?php
        echo $warningMessage;
    ?>
</div>

<?php if($askForDates) { //only display this form if we need to get the dats from the user?>
<!-- This form should be used to ask the user for the range of dates on the report -->
<section class='reportDatePickerForm'>
	<form class='datePickerForm' action="/presentation/views/reports/salesReport.php" method="GET">
    	<div class='datePickerFormElements'>
    		<label for="begin">Beginning Date:</label>
    		<input type="date" id="begin" name="BeginningDate">
    	</div>
    	<div class='datePickerFormElements'>
    		<label for="end">Ending Date:</label>
    		<input type="date" id="end" name="EndingDate">
    	</div>
    	
    	<div class='datePickerFormElements'>
    		<button type="submit" name='Generate' value='Normal'>Generate</button>
    		<button type="submit" name='Generate' value='JSON'>Generate JSON</button>
    	</div>
	</form>
</section>
<?php 
    } 
    else {
        if(isset($ordersList) && $ordersList != null) {
            include '_displaySalesReport.php'; 
            echo "<div style='margin: auto; width: 50px; padding: 20px;'>
                      <div class='datePickerFormElements'>
                          <button onclick='history.back()'>Back</button>
                      </div>
                  </div>";
        }
    }
?>

<!-- footer -->
<?php include $_SERVER['DOCUMENT_ROOT']. '/utility/_footer.php'?>