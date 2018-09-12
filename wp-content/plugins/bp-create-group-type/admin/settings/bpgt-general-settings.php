<?php
/**
 * Bp add group type general setting file.
 *
 * @since    1.0.0
 * @author   Wbcom Designs
 * @package  Bp_Add_Group_Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $bp_grp_types;
?>
<form method="POST" action="">
	<table class="form-table wcctp-admin-page-table">
		<tbody>
			<!-- GROUP TYPES PRE-SELECTED -->
			<tr>
				<th scope="row"><label for="group-types-selection"><?php esc_html_e( 'Pre-select Group Types', 'bp-add-group-types' ); ?></label></th>
				<td>
					<input type="checkbox" value="" name="bpgt-group-types-pre-selected" id="bpgt-group-types-pre-selected" <?php echo ( isset( $bp_grp_types->group_types_pre_selected ) && 'yes' === $bp_grp_types->group_types_pre_selected ) ? 'checked' : ''; ?> />
					<label for="bpgt-group-types-pre-selected"><?php esc_html_e( 'Pre-select all the group types', 'bp-add-group-types' ); ?></label>
					<p class="description"><?php esc_html_e( 'This setting will pre-select all the group types that get listed during group creation.', 'bp-add-group-types' ); ?></p>
				</td>
			</tr>

			<!-- GROUP TYPE SEARCH -->
			<tr>
				<th scope="row"><label for="group-types-search"><?php esc_html_e( 'Enable Group Type Search', 'bp-add-group-types' ); ?></label></th>
				<td>
					<input type="checkbox" value="" name="bpgt-group-types-search-enabled" id="bpgt-group-types-search-enabled" <?php echo ( isset( $bp_grp_types->group_type_search_enabled ) && 'yes' === $bp_grp_types->group_type_search_enabled ) ? 'checked' : ''; ?> />
					<label for="bpgt-group-types-search-enabled"><?php esc_html_e( 'Group type searching on front-end', 'bp-add-group-types' ); ?></label>
					<p class="description"><?php esc_html_e( 'This setting will enable the group type searching on the <strong>domain.com/groups</strong> page.', 'bp-add-group-types' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<?php wp_nonce_field( 'bpgt', 'bpgt-general-settings-nonce' ); ?>
		<input type="submit" name="bpgt_submit_general_settings" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'bp-add-group-types' ); ?>">
	</p>
</form>
