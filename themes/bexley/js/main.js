/**
 * responsiveNavigation.js v1.1
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 */

;(function($) {
	$.fn.responsiveNavigation = function(options) {

		var defaults, display, resized;

		defaults = {
			min_menu_size: 4,
			prefix: '-',
			ignore_children: false,
			breakpoint: 449
		};

		options = $.extend(defaults, options);

		display = function() {
			var window_width = $(window).width();
			if (window_width < options.breakpoint) {
				$('.rn_nav').hide();
				$('.rn_select').show();
			}

			if (window_width > options.breakpoint) {
				$('.rn_nav').show();
				$('.rn_select').hide();
			}
		};

		$ (window).resize(function() {
			resized = true;
		});

		// super simple debounce
		// fires once every half second to do the work if needed
		setInterval( function() {
			if ( resized ) {
				display();
			}
			resized = false;
		}, 500 );

		return this.each(function() {
			var $this, select, navDepth;

			$this = $(this);

			if ($this.find('a').length > options.min_menu_size) {
				$this.addClass('rn_nav');

				select = $('<select class="rn_select"></select>');
				navDepth = $this.parents().length;

				// add default text
				var navOptions = $('<option></option>');
				navOptions.text(js_i18n.menu);
				navOptions.attr('value', '');

				select.append(navOptions);

				$this.find('a').each(function() {
					var depth, i, optionText, navOptions;

					depth = (($(this).parents().length - navDepth) / 2) - 1;

					if (depth === 0 || (depth > 0 && options.ignore_children === false)) {

						optionText = $(this).text();
						if (depth > 0) {
							optionText = ' ' + optionText;
						}
						for (i = 0; i < depth; i ++) {
							optionText = options.prefix + optionText;
						}
						navOptions = $('<option></option>');
						navOptions.attr('value', $(this).attr('href'));
						if (document.location === $(this).attr('href')) {
							navOptions.attr('selected', 'selected');
						}
						navOptions.text(optionText);
						select.append(navOptions);

					}

				});

				select.change(function() {
					if ( this.value !== '' ) {
						document.location = this.value;
					}
				});
			}

			$this.after(select);
			display();
		});

	};

})(jQuery);


(function($){

	var masonry_footer_properties = {};

	$(document).ready(function(){

		// Set default heights for social media widgets

		// Twitter
		$( 'a.twitter-timeline' ).each( function() {

			var thisHeight = $( this ).attr( 'height' );
			$( this ).parent().css( 'min-height', thisHeight + 'px' );

		} );

		// Facebook
		$( '.fb-page' ).each( function() {

			var $set_height = $( this ).data( 'height' );
			var $show_facepile = $( this ).data( 'show-facepile' );
			var $show_posts = $( this ).data( 'show-posts' ); // AKA stream
			var $min_height = $set_height; // set the default 'min-height'

			// These values are defaults from the FB widget.
			var $no_posts_no_faces = 130;
			var $no_posts = 220;

			if ( $show_posts ) {

				// Showing posts; may also be showing faces and/or cover - the latter doesn't affect the height at all.
				$min_height = $set_height;

			} else if ( $show_facepile ) {

				// Showing facepile with or without cover image - both would be same height.
				// If the user selected height is lower than the no_posts height, we'll use that instead
				$min_height = ( $set_height < $no_posts ) ? $set_height : $no_posts;

			} else {

				// Either just showing cover, or nothing is selected (both are same height).
				// If the user selected height is lower than the no_posts_no_faces height, we'll use that instead
				$min_height = ( $set_height < $no_posts_no_faces ) ? $set_height : $no_posts_no_faces;

			}

			// apply min-height to .fb-page container
			$( this ).css( 'min-height', $min_height + 'px' );

		} );


		// Dropdown menus.
		$( 'ul#nav' ).superfish({
			animation: { opacity:'show',height:'show' },
			speed: 250
		});

		// Responsve nav.
		$( 'ul#nav' ).responsiveNavigation();

		// Masonry.
		$( window ).load( function() {

			if ( $.isFunction( $.fn.masonry ) ) {

				masonry_footer_properties = {
					itemSelector: '.widget',
					gutter: 0,
					isResizable: true,
					isOriginLeft: ! $( 'body' ).is( '.rtl' )
				};

				$( '#footer-widgets' ).masonry( masonry_footer_properties );

			}

		});

		// Add links to post content.
		add_showcase_links();

		$( 'body' ).on( 'post-load', function(){
			add_showcase_links();
		});

	});

	function add_showcase_links() {

		$( 'article .showcase' ).click(function() {
			if ( ! $(this).hasClass( 'can_click' ) ) {
				var url = $(this).find( 'h2.posttitle a' ).attr( 'href' );
				document.location.href = url;

				$(this).addClass( 'can_click' );
			}
		});

	}

})(jQuery);
