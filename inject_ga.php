<?php

/**
 * The file description. *
 * @package Pico
 * @subpackage injectGa
 * @version 1.0.0
 * @author markus schuer <markus.schuer@gmail.com>
 *
 */
class Inject_Ga {

    public function __construct() {
		
    }
	public function config_loaded(&$settings) {
		if (isset($settings['google_tracking_id'])) {
            $this->googleTrackingId = $settings['google_tracking_id'];
		}
    }
	
	public function before_render(&$twig_vars, &$twig) {
		if (!empty($this->googleTrackingId)) {
			$twig_vars['googletrackingcode'] = '
			<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push([\'_setAccount\', \'' . $this->googleTrackingId . '\']);
			_gaq.push([\'_trackPageview\']);
			(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
			})();
			</script>
			';
		}
    }
}
