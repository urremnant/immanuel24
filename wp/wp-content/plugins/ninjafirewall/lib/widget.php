<?php
/*
 +---------------------------------------------------------------------+
 | NinjaFirewall (WP Edition)                                          |
 |                                                                     |
 | (c) NinTechNet - https://nintechnet.com/                            |
 +---------------------------------------------------------------------+
 | This program is free software: you can redistribute it and/or       |
 | modify it under the terms of the GNU General Public License as      |
 | published by the Free Software Foundation, either version 3 of      |
 | the License, or (at your option) any later version.                 |
 |                                                                     |
 | This program is distributed in the hope that it will be useful,     |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of      |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the       |
 | GNU General Public License for more details.                        |
 +---------------------------------------------------------------------+ i18n++ / sa2
*/

if (! defined( 'NFW_ENGINE_VERSION' ) ) {
	header('HTTP/1.1 404 Not Found');
	header('Status: 404 Not Found');
	exit;
}

// Return immediately if user is not allowed (only the admin can see the widget):
if (nf_not_allowed( 0, __LINE__ ) ) { return; }

wp_add_dashboard_widget( 'nfw_dashboard_welcome', esc_html__('NinjaFirewall Statistics', 'ninjafirewall'), 'nfw_stats_widget' );

global $wp_meta_boxes;
if ( is_multisite() ) {
	$dashboard = 'dashboard-network';
} else {
	$dashboard = 'dashboard';
}
if (! empty( $wp_meta_boxes[$dashboard]['normal']['core'] ) ) {
	$wpmb			= $wp_meta_boxes[$dashboard]['normal']['core'];
	$nfwidget	= ['nfw_dashboard_welcome' => $wpmb['nfw_dashboard_welcome'],];
	$wp_meta_boxes[$dashboard]['normal']['core'] = array_merge( $nfwidget, $wpmb );
}

function nfw_stats_widget() {

	$stat_file = NFW_LOG_DIR . '/nfwlog/stats_' . date( 'Y-m' ) . '.php';
	if ( file_exists( $stat_file ) ) {
		$nfw_stat = file_get_contents( $stat_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
		$nfw_stat = str_replace( '<?php exit; ?>', '', $nfw_stat );
	} else {
		$nfw_stat = '0:0:0:0:0:0:0:0:0:0';
	}
	list($tmp, $medium, $high, $critical) = explode(':', $nfw_stat . ':');
	$medium		= (int) $medium;
	$high			= (int) $high;
	$critical	= (int) $critical;
	$total 		= $critical + $high + $medium;
	if ( $total ) {
		$coef			= 100 / $total;
		$critical	= round( $critical * $coef, 2);
		$high			= round( $high * $coef, 2);
		$medium		= round( $medium * $coef, 2);
	}
	echo '
	<table border="0" width="100%">
		<tr>
			<th width="50%" align="left"><h3>' . esc_html__('Blocked threats', 'ninjafirewall') .'</h3></th>
			<td width="50%" align="left">' . number_format_i18n( $total ) . '</td>
		</tr>
		<tr>
			<th width="50%" align="left"><h3>' . esc_html__('Threats level', 'ninjafirewall') .'</h3></th>
			<td width="50%" align="left">
				<i>' . esc_html__('Critical:', 'ninjafirewall') . ' ' . $critical . '%</i>
				<br />
				<table bgcolor="#DFDFDF" border="0" cellpadding="0" cellspacing="0" height="14" width="100%" align="left" style="height:14px;">
					<tr>
						<td width="' . round( $critical) . '%" background="' . plugins_url() . '/ninjafirewall/images/bar-critical.png" style="padding:0px"></td><td width="' . round(100 - $critical) . '%" style="padding:0px"></td>
					</tr>
				</table>
				<br />
				<i>' . esc_html__('High:', 'ninjafirewall') . ' ' . $high . '%</i>
				<br />
				<table bgcolor="#DFDFDF" border="0" cellpadding="0" cellspacing="0" height="14" width="100%" align="left" style="height:14px;">
					<tr>
						<td width="' . round( $high) . '%" background="' . plugins_url() . '/ninjafirewall/images/bar-high.png" style="padding:0px"></td><td width="' . round(100 - $high) . '%" style="padding:0px"></td>
					</tr>
				</table>
				<br />
				<i>' . esc_html__('Medium:', 'ninjafirewall') . ' ' . $medium . '%</i>
				<br />
				<table bgcolor="#DFDFDF" border="0" cellpadding="0" cellspacing="0" height="14" width="100%" align="left" style="height:14px;">
					<tr>
						<td width="' . round( $medium) . '%" background="' . plugins_url() . '/ninjafirewall/images/bar-medium.png" style="padding:0px;"></td><td width="' . round(100 - $medium) . '%" style="padding:0px;"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div align="right" class="activity-block"><a style="text-decoration:none" href="admin.php?page=NinjaFirewall&tab=statistics">' . esc_html__('View statistics', 'ninjafirewall') .'</a>&nbsp;&nbsp;-&nbsp;&nbsp;<a style="text-decoration:none" href="admin.php?page=nfsublog">' . esc_html__('View firewall log', 'ninjafirewall') .'</a></div>';
}
// =====================================================================
// EOF
