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
		  per -=.0025;
	  }
	  if (per>=0 && per <.5) {
		  document.getElementById("fade").style.opacity=per;
		  per-=0.01;
	  }
	  if (per<0){
		  document.getElementById("fade").style.display='none';
	  }
	  setTimeout("repeat()",20);
	}
</script>

<!-- GOOGLE ANALYTICS -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-12319114-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- END GOOGLE ANALYTICS -->