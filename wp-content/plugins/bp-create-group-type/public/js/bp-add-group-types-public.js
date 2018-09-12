(function( $ ) {
	'use strict';
	var group_all_clicked = true;

	var object = 'groups';// wbcom_agt_bp_filter_request
	jq.cookie(
		'bp-' + object + '-extras', '', {
			path: '/'
		}
	);

	$( document ).on(
		'change', 'select.bpgt-groups-search-group-type', function(){
			//alert('trigger');
			if( !group_all_clicked ) {
				return;
			}
			bp_filter_request(
				object,
				jq.cookie( 'bp-' + object + '-filter' ),
				jq.cookie( 'bp-' + object + '-scope' ),
				'div.' + object,
				$( '#' + object + '_search' ).val(),// ( '#bpgt-groups-search-text' ).val(),
				1,
				'group_type=' + $( this ).val(),
				'',
				''
			);
		}
	);

	// Submit group search
	$( document ).on(
		'click', '#bpgt-groups-search-submit', function(){
			return;
			var object = 'groups';// wbcom_agt_bp_filter_request.
			bp_filter_request(
				object,
				jq.cookie( 'bp-' + object + '-filter' ),
				jq.cookie( 'bp-' + object + '-scope' ),
				'div.' + object,
				$( '#bpgt-groups-search-text' ).val(),
				1,
				'group_type=' + $( '#bpgt-groups-search-group-type' ).val(),
				'',
				''
			);
			jq.cookie(
				'bp-' + object + '-extras', '', {
					path: '/'
				}
			);

			return;

			var search_type    = $( this ).data( 'search_type' );
			var process_search = true;
			if ( search_type == 'both' ) {
				if ( $( '#bpgt-groups-search-text' ).val() == '' && $( '#bpgt-groups-search-group-type' ).val() == '' ) {
					process_search = false;
				} else {
					var data = {
						'action'		: 'bpgt_search_groups',
						'search_type'	: search_type,
						'search_text'	: $( '#bpgt-groups-search-text' ).val(),
						'group_type'	: $( '#bpgt-groups-search-group-type' ).val()
					}
				}

			}

			if ( search_type == 'select' ) {
				process_search = true;
				var data = {
					'action'		: 'bpgt_search_groups',
					'search_type'	: search_type,
					'group_type'	: $( '#bpgt-groups-search-group-type' ).val()
				}
			}

			if ( process_search == true ) {
				$.ajax(
					{
						dataType: "JSON",
						url: bpgt_front_js_object.ajaxurl,
						type: 'POST',
						data: data,
						success: function( response ) {
							//console.log( response );
							$( '#groups-dir-list' ).html( response['data']['groups_html'] );
							//console.log( response['data']['message'] );
						},
					}
				);
			}

		}
	);

	function wbcom_agt_bp_filter_request( object, filter, scope, target, search_terms, page, extras, caller, template ) {
		if ( 'activity' === object ) {
			return false;
		}
		if ( null === scope ) {
			scope = 'all';
		}
		/* Set the correct selected nav and filter */
		jq( '.item-list-tabs li' ).each(
			function() {
					jq( this ).removeClass( 'selected' );
			}
		);
		jq( '#' + object + '-' + scope + ', #object-nav li.current' ).addClass( 'selected' );
		jq( '.item-list-tabs li.selected' ).addClass( 'loading' );
		jq( '.item-list-tabs select option[value="' + filter + '"]' ).prop( 'selected', true );
		if ( 'friends' === object || 'group_members' === object ) {
			object = 'members';
		}
		if ( bp_ajax_request ) {
			bp_ajax_request.abort();
		}
		bp_ajax_request = jq.post(
			ajaxurl, {
				action: object + '_filter',
					// 'cookie': bp_get_cookies(),
				'object': object,
				'filter': filter,
				'search_terms': search_terms,
				'scope': scope,
				'page': page,
				'extras': extras,
				'template': template
			},
			function(response)
			{
				/* animate to top if called from bottom pagination */
				if ( caller === 'pag-bottom' && jq( '#subnav' ).length ) {
					var top = jq( '#subnav' ).parent();
					jq( 'html,body' ).animate(
						{scrollTop: top.offset().top}, 'slow', function() {
							jq( target ).fadeOut(
								100, function() {
									jq( this ).html( response );

									/* KLEO added */
									jq( this ).fadeIn(
										100, function(){
											jq( "body" ).trigger( 'gridloaded' );
										}
									);
								}
							);
						}
					);

				} else {
					jq( target ).fadeOut(
						100, function() {
							jq( this ).html( response );
							jq( this ).fadeIn(
								100, function(){
									/* KLEO added */
									jq( "body" ).trigger( 'gridloaded' );
								}
							);
						}
					);
				}

				jq( '.item-list-tabs li.selected' ).removeClass( 'loading' );

			}
		);
	}

})( jQuery );

jQuery(document).ready(function($){
	jQuery( '.bpgt-type-tab' ).on('click', function(){
			group_all_clicked = false;
			jQuery('.bpgt-groups-search-group-type').val('').trigger('change');
			jQuery('#groups_search').val('').trigger('submit');
	});

	jQuery( '.item-list-tabs #group-all' ).on('click', function(){
			group_all_clicked = true;
	});
});
