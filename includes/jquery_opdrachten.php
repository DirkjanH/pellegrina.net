<script src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/includes/jquery.tablesorter.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
   $("#berichten").tablesorter({ 
        // pass the headers argument and assign a object 
        headers: { 
            // assign the first column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            } 
		}
    }); 
   $(".gestreept tr:even").addClass("zebra");
   $(".tablesorter tr").mouseover(function(){$(this).addClass("over");}).mouseout(function(){$(this).removeClass("over");});
 });
</script>
