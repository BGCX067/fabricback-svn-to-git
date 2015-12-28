<? if (isset($error) && (!is_array($error) || count($error) != 0)) { ?>
  <div class="error" id="fade">
    <?
        if (is_array($error)) {
            foreach ($error as $e) {
                echo $e . '<br/>';
            }
        } else {
            echo $error;
        }
    ?>
  </div>
<? } ?>

<script type="text/javascript">
	var per=1;
	repeat();
	function repeat() {
	  if( per >=.5 ){
		  per -=.0015;
	  }
	  if (per>=0 && per <.5) {
		  document.getElementById("fade").style.opacity=per;
		  per-=0.01;
	  }
	  if (per<0){
		  document.getElementById("fade").style.visibility='hidden';
	  }
	  setTimeout("repeat()",20);
	}
</script>