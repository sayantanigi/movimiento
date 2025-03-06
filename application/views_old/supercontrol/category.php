<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
		.topul li {
			list-style-type:none;
				
		}
		select option{
			font-size:24px !important;
			padding-left:20px !important;
		}
		select .art{
			padding-left:20px !important;	
			margin-left:20px !important;	
		}
		select .art2{
			padding-left:40px !important;	
			margin-left:40px !important;	
		}
		</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script>
        $(document).ready(function(){
            $("#check").click(function(){
                $("#drop").toggle(1000);
            });
            
        });
        </script>
    </head>
    <body>
   			<div id="check" style="border:1px solid; width:20%;">
            select category
            </div>
            	<div id="drop" style="display:none; width:20%; border:1px solid #ccc;">
        			<?php echo $categories;?>
                </div>    
     		
     
     
    </body>
</html>