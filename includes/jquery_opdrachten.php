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
<style type="text/css">
/* tables */
table.tablesorter {
	margin:10px 0pt 15px;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	border: 1px solid #FFF;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(/Images/Logos/bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer; 
}
table.tablesorter tbody td {
	border: 1px solid #FFF;
	padding: 4px;
	vertical-align: top;
}
table.tablesorter tbody tr:nth-of-type(odd) {
	color: #333;
	background: #DDD;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(/Images/Logos/asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(/Images/Logos/desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
	background-color: #FF4848;
}
</style>
