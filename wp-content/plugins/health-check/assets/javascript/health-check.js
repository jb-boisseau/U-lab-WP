jQuery( document ).ready(function( $ ) {
	$( '.health-check-accordion-trigger' ).click(function() {
		var isExpanded = ( 'true' === $( this ).attr( 'aria-expanded' ) );

		if ( isExpanded ) {
			$( this ).attr( 'aria-expanded', 'false' );
			$( '#' + $( this ).attr( 'aria-controls' ) ).attr( 'hidden', true );
		} else {
			$( this ).attr( 'aria-expanded', 'true' );
			$( '#' + $( this ).attr( 'aria-controls' ) ).attr( 'hidden', false );
		}
	});

	$( '.health-check-accordion' ).on( 'keyup', '.health-check-accordion-trigger', function( e ) {
		if ( '38' === e.keyCode.toString() ) {
			$( '.health-check-accordion-trigger', $( this ).closest( 'dt' ).prevAll( 'dt' ) ).focus();
		} else if ( '40' === e.keyCode.toString() ) {
			$( '.health-check-accordion-trigger', $( this ).closest( 'dt' ).nextAll( 'dt' ) ).focus();
		}
	});
});

/* global HealthCheck */
jQuery( document ).ready(function( $ ) {
	$( '.health-check-copy-field' ).click(function( e ) {
		var $textarea = $( 'textarea', $( this ).closest( 'div' ) ),
			$button   = $( this ),
			copied    = false;

		e.preventDefault();

		$textarea.select();

		copied = document.execCommand( 'copy' );
		if ( copied ) {
			$button.text( HealthCheck.string.copied );
		}
	});
});

jQuery( document ).ready(function( $ ) {
	$( '.health-check-toc' ).click(function( e ) {

		// Remove the height of the admin bar, and an extra 10px for better positioning.
		var offset = $( $( this ).attr( 'href' ) ).offset().top - $( '#wpadminbar' ).height() - 10;

		e.preventDefault();

		$( 'html, body' ).animate({
			scrollTop: offset
		}, 1200 );
	});
});

/* global ajaxurl */
jQuery( document ).ready(function( $ ) {
	function healthCheckFailureModal( markup, action, parent ) {
		$( '#dynamic-content' ).html( markup );
		$( '.health-check-modal' ).data( 'modal-action', action ).data( 'parent-field', parent ).show();
	}

	function healthCheckFailureModalClose( modal ) {
		modal.hide();
	}

	$( '.modal-close' ).click(function( e ) {
		e.preventDefault();
		healthCheckFailureModalClose( $( this ).closest( '.health-check-modal' ) );
	});

	$( '.health-check-modal' ).on( 'submit', 'form', function( e ) {
		var data = $( this ).serializeArray(),
			modal = $( this ).closest( '.health-check-modal' );

		e.preventDefault();

		$.post(
			ajaxurl,
			data,
			function( response ) {
				if ( true === response.success ) {
					$( modal.data( 'parent-field' ) ).append( response.data.message );
				} else {
					healthCheckFailureModal( response.data.message, data.action, modal.data( 'parent-field' ) );
				}
			}
		);

		healthCheckFailureModalClose( modal );
	});
});

/* global HealthCheck, ajaxurl, healthCheckFailureModal */
jQuery( document ).ready(function( $ ) {
	function testDefaultTheme() {
		var $parent = $( '.individual-loopback-test-status', '#test-single-no-theme' ),
			data = {
				action: 'health-check-loopback-default-theme'
			};

		$.post(
			ajaxurl,
			data,
			function( response ) {
				if ( true === response.success ) {
					$parent.html( response.data.message );
				} else {
					healthCheckFailureModal( response.data, data.action, $parent );
				}
			},
			'json'
		);
	}

	function testSinglePlugin() {
		var $testLines = $( '.not-tested', '#loopback-individual-plugins-list' );
		var $parentField,
			$testLine,
			data;

		if ( $testLines.length < 1 ) {
			testDefaultTheme();
			return null;
		}

		$testLine = $testLines.first();
		data = {
			action: 'health-check-loopback-individual-plugins',
			plugin: $testLine.data( 'test-plugin' )
		};

		$parentField = $( '.individual-loopback-test-status', $testLine );

		$parentField.html( HealthCheck.string.running_tests );

		$.post(
			ajaxurl,
			data,
			function( response ) {
				if ( true === response.success ) {
					$testLine.removeClass( 'not-tested' );
					$parentField.html( response.data.message );
					testSinglePlugin();
				} else {
					healthCheckFailureModal( response.data, data.action, $parentField );
				}
			},
			'json'
		);
	}

	$( '.dashboard_page_health-check' ).on( 'click', '#loopback-no-plugins', function( e ) {
		var $trigger = $( this ),
			$parent = $( this ).closest( 'td' ),
			data = {
				action: 'health-check-loopback-no-plugins'
			};

		e.preventDefault();

		$( this ).html( '<span class="spinner" style="visibility: visible;"></span> ' + HealthCheck.string.please_wait );

		$.post(
			ajaxurl,
			data,
			function( response ) {
				$trigger.remove();
				if ( true === response.success ) {
					$parent.append( response.data.message );
				} else {
					healthCheckFailureModal( response.data, data.action, $parent );
				}
			},
			'json'
		);
	}).on( 'click', '#loopback-individual-plugins', function( e ) {
		e.preventDefault();

		testSinglePlugin();
	});
});

/* global ajaxurl */
jQuery( document ).ready(function( $ ) {
	$( '.health-check-site-status-test' ).each( function() {
		var $check = $( this ),
			data = {
				action: 'health-check-site-status',
				feature: $( this ).data( 'site-status' )
			};

		$.post(
			ajaxurl,
			data,
			function( response ) {
				$check.html( response );
			}
		);
	});
});

/* global ajaxurl */
jQuery( document ).ready(function( $ ) {
	$( '#health-check-file-integrity' ).submit( function( e ) {
		var data = {
			'action': 'health-check-files-integrity-check'
		};

		e.preventDefault();

		$( '#tools-file-integrity-response-holder' ).html( '<span class="spinner"></span>' );
		$( '#tools-file-integrity-response-holder .spinner' ).addClass( 'is-active' );

		$.post(
			ajaxurl,
			data,
			function( response ) {
				$( '#tools-file-integrity-response-holder .spinner' ).removeClass( 'is-active' );
				$( '#tools-file-integrity-response-holder' ).parent().css( 'height', 'auto' );
				$( '#tools-file-integrity-response-holder' ).html( response.data.message );
			}
		);
	});

	$( '#tools-file-integrity-response-holder' ).on( 'click', 'a[href="#health-check-diff"]', function( e ) {
		var file = $( this ).data( 'file' ),
			data;

		e.preventDefault();

		$( '#health-check-diff-modal' ).toggle();
		$( '#health-check-diff-modal #health-check-diff-modal-content .spinner' ).addClass( 'is-active' );

		data = {
			'action': 'health-check-view-file-diff',
			'file': file
		};

		$.post(
			ajaxurl,
			data,
			function( response ) {
				$( '#health-check-diff-modal #health-check-diff-modal-diff' ).html( response.data.message );
				$( '#health-check-diff-modal #health-check-diff-modal-content h3' ).html( file );
				$( '#health-check-diff-modal #health-check-diff-modal-content .spinner' ).removeClass( 'is-active' );
			}
		);
	});
});

jQuery( document ).ready(function( $ ) {
	$( '#health-check-diff-modal' ).on( 'click', 'a[href="#health-check-diff-modal-close"]', function( e ) {
		e.preventDefault();
		$( '#health-check-diff-modal' ).toggle();
		$( '#health-check-diff-modal #health-check-diff-modal-diff' ).html( '' );
		$( '#health-check-diff-modal #health-check-diff-modal-content h3' ).html( '' );
	});

	$( document ).keyup(function( e ) {
		if ( 27 === e.which ) {
			$( '#health-check-diff-modal' ).css( 'display', 'none' );
			$( '#health-check-diff-modal #health-check-diff-modal-diff' ).html( '' );
			$( '#health-check-diff-modal #health-check-diff-modal-content h3' ).html( '' );
		}
	});
});

/* global ajaxurl */
jQuery( document ).ready(function( $ ) {
	$( '#health-check-mail-check' ).submit( function( e ) {
		var email = $( '#health-check-mail-check #email' ).val(),
			emailMessage = $( '#health-check-mail-check #email_message' ).val(),
			data;

		e.preventDefault();

		$( '#tools-mail-check-response-holder' ).html( '<span class="spinner"></span>' );
		$( '#tools-mail-check-response-holder .spinner' ).addClass( 'is-active' );

		data = {
			'action': 'health-check-mail-check',
			'email': email,
			'email_message': emailMessage
		};

		$.post(
			ajaxurl,
			data,
			function( response ) {
				$( '#tools-mail-check-response-holder .spinner' ).removeClass( 'is-active' );
				$( '#tools-mail-check-response-holder' ).parent().css( 'height', 'auto' );
				$( '#tools-mail-check-response-holder' ).html( response.data.message );
			}
		);
	});
});
