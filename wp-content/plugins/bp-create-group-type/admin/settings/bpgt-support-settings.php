<?php
/**
 * Bp add group type support file.
 *
 * @since    1.0.0
 * @author   Wbcom Designs
 * @package  Bp_Add_Group_Types
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bpgt-adming-setting">
	<div class="bpgt-tab-header"><h3><?php esc_html_e( 'Have some questions?', 'bp-add-group-types' ); ?></h3></div>

	<div class="bpgt-admin-settings-block">
		<div id="bpgt-settings-tbl">
			<div class="bpgt-admin-row">
				<div>
					<button class="bpgt-accordion"><?php esc_html_e( 'What plugin does this plugin require?', 'bp-add-group-types' ); ?></button>
					<div class="bpgt-panel">
						<p><?php esc_html_e( 'As the name of the plugin justifies, this plugin helps create Group Types for BuddyPress Groups, this plugin requires BuddyPress plugin to be installed and active.', 'bp-add-group-types' ); ?></p>
						<p><?php esc_html_e( 'You\'ll also get an admin notice and the plugin will become ineffective if the required plugin will not be there.', 'bp-add-group-types' ); ?></p>
					</div>
				</div>
			</div>
			<div class="bpgt-admin-row">
				<div>
					<button class="bpgt-accordion">
					<?php
					esc_html_e(
						'How does
                    Pre-select Group Types setting work provided in general setting section?', 'bp-add-group-types'
					);
?>
</button>
					<div class="bpgt-panel">
						<p><?php esc_html_e( 'This setting will pre-select all the created group type while creating a new group.', 'bp-add-group-types' ); ?></p>
					</div>
				</div>
			</div>
			<div class="bpgt-admin-row">
				<div>
					<button class="bpgt-accordion">
					<?php
					esc_html_e(
						'How does
                    Enable Group Type Search setting work provided in general setting section?', 'bp-add-group-types'
					);
?>
</button>
					<div class="bpgt-panel">
						<p><?php esc_html_e( 'This setting provide filter at domain.com/groups page for searching groups by created group types.', 'bp-add-group-types' ); ?></p>
					</div>
				</div>
			</div>
			<div class="bpgt-admin-row">
				<div>
					<button class="bpgt-accordion"><?php esc_html_e( 'How to a create group type?', 'bp-add-group-types' ); ?></button>
					<div class="bpgt-panel">
						<p><?php esc_html_e( 'A new group type can be created with help of interface provided at plugin settings page under Group Types tab section.', 'bp-add-group-types' ); ?></p>
					</div>
				</div>
			</div>
			<div class="bpgt-admin-row">
				<div>
					<button class="bpgt-accordion"><?php esc_html_e( 'How to go for any custom development?', 'bp-add-group-types' ); ?></button>
					<div class="bpgt-panel">
						<p><?php esc_html_e( 'If you need additional help you can contact us for <a href="https://wbcomdesigns.com/contact/" target="_blank" title="Custom Development by Wbcom Designs">Custom Development</a>.', 'bp-add-group-types' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
