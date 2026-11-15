<script type="text/javascript">
  function ToggleText(id) {
   if (document.getElementById) {
	var cont = document.getElementById(id + "_vragen").style;
	var box = document.getElementById(id + "_checkbox");
    if (cont.display == "table") {
    	cont.display = "none";
		box.checked = false;
    	} else {
        cont.display = "table";
		box.checked = true;
   		}
   	} 
}
</script>
