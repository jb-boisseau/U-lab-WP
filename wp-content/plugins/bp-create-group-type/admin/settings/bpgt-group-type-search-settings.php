<?php
/**
 * Bp add group type search setting file.
 *
 * @since    1.0.0
 * @author   Wbcom Designs
 * @package  Bp_Add_Group_Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed firectly.
}
global $bp_grp_types;
?>
<form method="POST" action="">
	<table class="form-table bpgt-admin-page-table">
		<tbody>
			<!-- GROUP TYPES SEARCH SETTINGS -->
			<tr>
				<th scope="row"><label for="group-types-search-filter"><?php esc_html_e( 'Search Template Content', 'bp-add-group-types' ); ?></label></th>
				<td>
					<p>
						<input type="radio" value="textbox" name="bpgt-group-type-search-template" id="bpgt-group-type-search-textbox" <?php echo ( isset( $bp_grp_types->group_type_search_template ) && 'textbox' === $bp_grp_types->group_type_search_template ) ? 'checked' : ''; ?> required/>
						<label for="bpgt-group-type-search-textbox"><?php esc_html_e( 'Textbox', 'bp-add-group-types' ); ?><span class="description">&nbsp;&nbsp;[<?php esc_html_e( 'BuddyPress Group Search Textbox.', 'bp-add-group-types' ); ?>]</span></label>
					</p>
					<p>
						<input type="radio" value="select" name="bpgt-group-type-search-template" id="bpgt-group-type-search-select" <?php echo ( isset( $bp_grp_types->group_type_search_template ) && 'select' === $bp_grp_types->group_type_search_template ) ? 'checked' : ''; ?> />
						<label for="bpgt-group-type-search-select"><?php esc_html_e( 'Group Type Selectbox', 'bp-add-group-types' ); ?></label>
					</p>
					<p>
						<input type="radio" value="both" name="bpgt-group-type-search-template" id="bpgt-group-type-search-both" <?php echo ( isset( $bp_grp_types->group_type_search_template ) && 'both' === $bp_grp_types->group_type_search_template ) ? 'checked' : ''; ?> />
						<label for="bpgt-group-type-search-both"><?php esc_html_e( 'Both', 'bp-add-group-types' ); ?></label>
					</p>
					<p class="description"><?php esc_html_e( 'This setting will change the group search template in frontend.', 'bp-add-group-types' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<?php wp_nonce_field( 'bpgt-search-settings', 'bpgt-group-type-search-settings-nonce' ); ?>
		<input type="submit" name="bpgt_submit_group_type_search_settings" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'bp-add-group-types' ); ?>">
	</p>
</form>
