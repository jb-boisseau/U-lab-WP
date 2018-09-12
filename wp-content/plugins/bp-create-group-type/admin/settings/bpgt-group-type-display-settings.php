<?php
/**
 * Bp add group type display setting file.
 *
 * @since    1.0.0
 * @author   Wbcom Designs
 * @package  Bp_Add_Group_Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed firectly.
}
global $bp_grp_types;
$group_types                = $bp_grp_types->group_types;
$bpgt_type_display_settings = get_site_option( 'bpgt_type_display_settings' );
?>
<form method="POST" action="">
	<table class="form-table bpgt-admin-page-table">
		<tbody>
			<!-- GROUP TYPES DISPLAY SETTINGS -->
			<tr>
				<th scope="row"><label for="group-types-display"><?php esc_html_e( 'Display Group Type(s) as tab.', 'bp-add-group-types' ); ?></label></th>
				<td>
			<?php
			if ( is_array( $group_types ) && ! empty( $group_types ) ) {
				foreach ( $group_types as $key => $type ) {
				?>
					<p>
						<input type="checkbox" name="bpgt_group_type_display[]" value="<?php echo esc_attr( $type['slug'] ); ?>"
																									<?php
																									if ( is_array( $bpgt_type_display_settings ) && ! empty( $bpgt_type_display_settings ) ) {
																										if ( in_array( $type['slug'], $bpgt_type_display_settings, true ) ) {
																											echo 'checked="checked"'; }
																									}
?>
/>
						<label for="bpgt-group-type-search-textbox"><?php echo esc_html( $type['name'] ); ?></label>
					</p>
			<?php
				}
			}
?>
					<p class="description"><?php esc_html_e( 'This setting will display group types as tab in frontend groups directory .', 'bp-add-group-types' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<?php wp_nonce_field( 'bpgt-type-display-settings', 'bpgt_submit_group_type_display_settings' ); ?>
		<input type="submit" name="bpgt_submit_group_type_display_settings" class="button button-primary" value="<?php esc_html_e( 'Save Changes', 'bp-add-group-types' ); ?>">
	</p>
</form>
