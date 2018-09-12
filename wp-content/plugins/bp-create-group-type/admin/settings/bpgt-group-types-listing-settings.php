<?php
/**
 * Bp add group type search listing file.
 *
 * @since    1.0.0
 * @author   Wbcom Designs
 * @package  Bp_Add_Group_Types
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $bp_grp_types;
$group_types = $bp_grp_types->group_types;
$spinner_src = includes_url( '/images/spinner.gif' );

// Search Group Types.
if ( filter_input( INPUT_POST, 'bpgt-search', FILTER_SANITIZE_STRING ) !== null ) {
	$search_txt = sanitize_text_field( filter_input( INPUT_POST, 'group-type-search-input' ) );
	foreach ( $group_types as $key => $group_type ) {
		$name_pos = false;
		$slug_pos = false;
		$desc_pos = false;

		$name_pos = stripos( $group_type['name'], $search_txt );
		$slug_pos = stripos( $group_type['slug'], $search_txt );
		$desc_pos = stripos( $group_type['desc'], $search_txt );

		if ( false !== $name_pos || false !== $slug_pos || false !== $desc_pos ) {
			$result['group_types'][] = $group_type;
		}
	}
	if ( ! empty( $result['group_types'] ) ) {
		$group_types = $result['group_types'];
	}
}

$flag        = 0;
$bpgt_search = 'disabled';
if ( $group_types ) {
	$bpgt_search = '';
	$flag        = 1;
}
?>
<div class="wrap nosubsub">
	<form method="POST" action="">
		<p class="search-box">
			<label class="screen-reader-text" for="group-type-search-input"><?php esc_html_e( 'Search Group Types:', 'bp-add-group-types' ); ?></label>
			<input name="group-type-search-input" placeholder="<?php esc_html_e( 'Write here..', 'bp-add-group-types' ); ?>" type="text" <?php echo esc_attr( $bpgt_search ); ?> required value="<?php echo ( filter_input( INPUT_POST, 'group-type-search-input' ) ) ? esc_attr( $search_txt ) : ''; ?>">
			<input name="bpgt-search" class="button button-secondary" value="<?php esc_html_e( 'Search', 'bp-add-group-types' ); ?>" type="submit" <?php echo esc_attr( $bpgt_search ); ?>>
		</p>
	</form>

	<div id="col-container" class="wp-clearfix">
		<div id="col-left">
			<div class="col-wrap">
				<div class="form-wrap">
					<form action="" method="POST" enctype="multipart/form-data">
						<h2><?php esc_html_e( 'Add New Group Type', 'bp-add-group-types' ); ?></h2>
						<div class="form-field form-required term-name-wrap">
							<label for="group-type-name"><?php esc_html_e( 'Name', 'bp-add-group-types' ); ?></label>
							<input id="group-type-name" name="group-type-name" size="40" aria-required="true" type="text" required>
							<p><?php esc_html_e( 'The name is how it appears on your site.', 'bp-add-group-types' ); ?></p>
						</div>
						<div class="form-field term-slug-wrap">
							<label for="group-type-slug"><?php esc_html_e( 'Slug', 'bp-add-group-types' ); ?></label>
							<input name="group-type-slug" id="group-type-slug" size="40" type="text">
							<p><?php esc_html_e( 'The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.', 'bp-add-group-types' ); ?></p>
						</div>
						<div class="form-field term-description-wrap">
							<label for="group-type-description"><?php esc_html_e( 'Description', 'bp-add-group-types' ); ?></label>
							<textarea id="group-type-desc" name="group-type-desc" rows="5" cols="40"></textarea>
							<p><?php esc_html_e( 'The description is not prominent by default; however, some themes may show it.', 'bp-add-group-types' ); ?></p>
						</div>
						<p class="submit">
							<?php wp_nonce_field( 'bpgt-group-types', 'bpgt-add-group-types-nonce' ); ?>
							<input name="bpgt-add-group-type" class="button button-primary" value="<?php esc_html_e( 'Add New Group Type', 'bp-add-group-types' ); ?>" type="submit">
						</p>
					</form>
				</div>
			</div>
		</div><!-- /col-left -->

		<div id="col-right">
			<div class="col-wrap">
				<div class="tablenav top">
					<div class="tablenav-pages one-page">
						<span class="displaying-num">
							<?php echo ( count( $group_types ) > 1 ) || empty( $group_types ) ? count( $group_types ) . ' items' : '1 item'; ?>
						</span>
					</div>
					<br class="clear">
				</div>
				<table class="wp-list-table widefat fixed striped group-types">
					<thead>
						<tr>
							<th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
								<a href="javascript:void(0);">
									<span><?php esc_html_e( 'Name', 'bp-add-group-types' ); ?></span>
								</a>
							</th>
							<th scope="col" id="description" class="manage-column column-description sortable desc">

									<span><?php esc_html_e( 'Description', 'bp-add-group-types' ); ?></span>

							</th>
							<th scope="col" id="slug" class="manage-column column-slug sortable desc">
								<a href="javascript:void(0);">
									<span><?php esc_html_e( 'Slug', 'bp-add-group-types' ); ?></span>
								</a>
							</th>
						</tr>
					</thead>

					<tbody id="the-list" class="bpgt-list">
						<?php if ( 0 === $flag ) { ?>
							<tr class="bpgt-not-found">
								<td colspan="3"><?php esc_html_e( 'Group Types Not Found!', 'bp-add-group-types' ); ?></td>
							</tr>
						<?php } else { ?>
							<?php foreach ( $group_types as $group_type ) { ?>
								<tr class="bpgt-<?php echo esc_attr( $group_type['slug'] ); ?>">
									<td class="name column-name has-row-actions column-primary">
										<strong>
											<a class="row-title" href="javascript:void(0);" id="name-<?php echo esc_attr( $group_type['slug'] ); ?>">
												<?php echo esc_html( $group_type['name'] ); ?>
											</a>
										</strong>
										<br>
										<div class="row-actions">
											<span class="edit">
												<a class="edit-bpgt" href="javascript:void(0);" id="<?php echo esc_attr( $group_type['slug'] ); ?>">
													<?php esc_html_e( 'Edit', 'bp-add-group-types' ); ?>
												</a> |
											</span>
											<span class="delete">
												<a class="dlt-bpgt" href="javascript:void(0);" id="<?php echo esc_attr( $group_type['slug'] ); ?>">
													<?php esc_html_e( 'Delete', 'bp-add-group-types' ); ?>
												</a>
											</span>
										</div>
									</td>
									<td class="column-description" id="desc-<?php echo esc_attr( $group_type['slug'] ); ?>"><?php echo esc_attr( $group_type['desc'] ); ?></td>
									<td class="column-slug" id="slug-<?php echo esc_attr( $group_type['slug'] ); ?>"><?php echo esc_attr( $group_type['slug'] ); ?></td>
									<!--<td class="column-posts">2</td>-->
								</tr>

								<!-- Row Editor -->

								<tr class="inline-edit-row bpgt-editor" id="edit-bpgt-<?php echo esc_attr( $group_type['slug'] ); ?>">
									<td colspan="3" class="colspanchange">
										<fieldset>
											<legend class="inline-edit-legend">
												<?php esc_html_e( 'Edit', 'bp-add-group-types' ); ?> <?php echo esc_attr( $group_type['name'] ); ?>
											</legend>
											<div class="inline-edit-col">
												<label>
													<span class="title"><?php esc_html_e( 'Name', 'bp-add-group-types' ); ?></span>
													<span class="input-text-wrap">
														<input id="<?php echo esc_attr( $group_type['slug'] ); ?>-name" class="ptitle" value="<?php echo esc_attr( $group_type['name'] ); ?>" type="text">
													</span>
												</label>
												<label>
													<span class="title"><?php esc_html_e( 'Slug', 'bp-add-group-types' ); ?></span>
													<span class="input-text-wrap">
														<input id="<?php echo esc_attr( $group_type['slug'] ); ?>-slug" class="ptitle" value="<?php echo esc_attr( $group_type['slug'] ); ?>" type="text">
													</span>
												</label>
												<label>
													<span class="title">
														<?php esc_html_e( 'Description', 'bp-add-group-types' ); ?>
													</span>
													<span class="input-text-wrap">
														<textarea id="<?php echo esc_attr( $group_type['slug'] ); ?>-desc"><?php echo esc_attr( $group_type['desc'] ); ?></textarea>
													</span>
												</label>
											</div>
										</fieldset>
										<p class="inline-edit-save submit">
											<input type="button" class="close button button-secondary alignleft" value="<?php esc_html_e( 'Cancel', 'bp-add-group-types' ); ?>">
											<input class="bpgt-update button button-primary alignright" id="<?php echo esc_attr( $group_type['slug'] ); ?>" value="<?php esc_html_e( 'Update Group Type', 'bp-add-group-types' ); ?>" type="button">

											<span class="ajax-loader alignright" id="ajax-loader-for-<?php echo esc_attr( $group_type['slug'] ); ?>">
												<img src="<?php echo esc_url( $spinner_src ); ?>" alt="Loader" />
											</span>
											<br class="clear">
										</p>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div><!-- /col-right -->
	</div><!-- /col-container -->
</div>
