jQuery( document ).ready(
	function($){
			'use strict';

			/******************SUPPORT******************/
			var acc = document.getElementsByClassName( "bpgt-accordion" );
			var i;
		for ( i = 0; i < acc.length; i++ ) {
			acc[i].onclick = function() {
				this.classList.toggle( "active" );
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			}
		}
			$( document ).on(
				'click', '.bpgt-accordion', function(){
					return false;
				}
			);

			/******************SUPPORT******************/

			/******************GROUP TYPES LISTING******************/

			// Create slug as soon as group type name is entered
			$( document ).on(
				'keyup', '#group-type-name', function(){
					var slug = $( this ).val().toLowerCase().replace( / /g, "" );
					$( '#group-type-slug' ).val( slug );
				}
			);

			// Delete Group Types
			$( document ).on(
				'click', '.dlt-bpgt', function(){
					var slug = $( this ).attr( 'id' );
					if ( confirm( 'Your confirmation will delete the group type with slug : ' + slug ) == true ) {
						$( this ).html( 'Deleting..' );
						$( this ).closest( 'tr' ).css( 'background-color', '#FF9999' );
						$.post(
							ajaxurl,
							{
								'action' : 'bpgt_delete_group_type',
								'slug' : slug
							},
							function( response ){
								$( '.bpgt-' + slug ).remove();
								$( '#edit-bpgt-' + slug ).remove();
								console.log( response['data']['message'] );
							}
						);
					}
				}
			);

			// Edit Buddypress Group Types
			$( document ).on(
				'click', '.edit-bpgt', function(){
					var slug = $( this ).attr( 'id' );
					$( '.bpgt-editor' ).hide();
					$( '#edit-bpgt-' + slug ).show();
				}
			);

			// Close Editor Buddypress Group Types
			$( document ).on(
				'click', '.close', function(){
					$( '.bpgt-editor' ).hide();
				}
			);

			// Update Buddypress Group Types
			$( document ).on(
				'click', '.bpgt-update', function(){
					var curr_slug = $( this ).attr( 'id' );
					var new_name  = $( '#' + curr_slug + '-name' ).val();
					var new_slug  = $( '#' + curr_slug + '-slug' ).val();
					var new_desc  = $( '#' + curr_slug + '-desc' ).val();
					if ( new_slug == '' ) {
						lower_case_name = new_name.toLowerCase();
						new_slug        = lower_case_name.replace( / /g, "-" );
					}

					$( '#ajax-loader-for-' + curr_slug ).show();
					$.post(
						ajaxurl,
						{
							'action' : 'bpgt_update_group_type',
							'new_slug' : new_slug,
							'new_desc' : new_desc,
							'old_slug' : curr_slug,
							'new_name' : new_name
						},
						function( response ){
							$( '#ajax-loader-for-' + curr_slug ).hide();
							$( '.bpgt-editor' ).hide();
							$( '#desc-' + curr_slug ).html( new_desc );
							$( '#slug-' + curr_slug ).html( new_slug );
							$( '#name-' + curr_slug ).html( new_name );
							console.log( response['data']['message'] );
						}
					);
				}
			);

			/******************GROUP TYPES LISTING******************/

			/******************GENERAL SETTINGS******************/

			// SHow/hide the group type search tab
			$( document ).on(
				'change', '#bpgt-group-types-search-enabled', function(){
					if ( $( this ).prop( 'checked' ) == true ) {
						$( '#bpgt-search-tab' ).css( 'display', 'block' );
					} else {
						$( '#bpgt-search-tab' ).css( 'display', 'none' );
					}
				}
			);

			/******************GENERAL SETTINGS******************/

	}
);
