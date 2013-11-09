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
		if (isset($settings['site_title'])) {
			$this->site_title = $settings['site_title'];
		}
    }
	
	public function before_render(&$twig_vars, &$twig) {
		if (!empty($this->googleTrackingId)) {
			$twig_vars['googletrackingcode'] = '
			<script>
				(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

				ga(\'create\', \'' . $this->googleTrackingId . '\', \'' . $this->site_title . '\');
				ga(\'send\', \'pageview\');

			</script>
			';
		}
    }
}
