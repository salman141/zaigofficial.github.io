(function ($) {
	"use strict";
	$(document).ready(function($){
		var $win = $(window);
		// Sticky menu
		if($('#sns_header .main-header').length && $('body').hasClass('use_stickmenu')){
		    var headerOrgOffset = $('#sns_header .main-header').offset().top;
		    $(window).scroll(function() {
		        var currentScroll = $(this).scrollTop();
		        if(currentScroll > headerOrgOffset) {
		        	$('#sns_header .main-header').addClass('keep-menu');
		        } else {
		        	$('#sns_header .main-header').removeClass('keep-menu');
		        }
		    });
		}
		// Responsive menu
		$('.nav-sidebar.resp-nav').SnsAccordion({
			btn_open: '<span class="ac-tongle open"></span>',
			btn_close: '<span class="ac-tongle close"></span>',
		});
		$('.mini-search .tongle, .search-box .sbtn-close').on('click', function(e){
			e.preventDefault();
			if($('.search-box').hasClass('active')){
				$('.search-box').removeClass('active');
			} else {
				$('.search-box').addClass('active'); //$('.search-box input[name="s"]').focus();
			}
		});
		$('.menu-sidebar .tongle, .menu-sidebar .overlay').on('click', function(e){
			e.preventDefault();
			if($('.menu-sidebar .sidebar-content').hasClass('active')){
				$('.menu-sidebar .overlay').fadeOut(250);
				$('.menu-sidebar .sidebar-content').removeClass('active');
				$('body').removeClass('show-sidebar', 4000);
			} else {
				$('.menu-sidebar .overlay').fadeIn(250);
				$('.menu-sidebar .sidebar-content').addClass('active');
				$('body').addClass('show-sidebar');
			}
		});
		if (typeof $.fn.prettyPhoto !== 'undefined' && $('.sns-popup-video .btn-popupvideo').length ) {
			$('.sns-popup-video .btn-popupvideo').prettyPhoto({
				default_width: 750, default_height: 500,
				social_tools: false,
				opacity: 0.8,
				deeplinking: false,
			});
		}
		if ( $('#sns_content .sns-main .inner-sidebar.right').length ) {
			$('body').addClass('have-inner-right');
		}
		if ( $('#sns_content .sns-main .inner-sidebar.left').length ) {
			$('body').addClass('have-inner-left');
		}
		// One level 1 active
		var menu_m = '#sns_mainmenu > ul > li';
		$(menu_m).each(function(){
			var item_m = $(this);
			if ( item_m.hasClass('current-product-ancestor') || item_m.hasClass('current-menu-parent') || item_m.hasClass('current-product-parent') ) {
				var arr_i_m = '#' + item_m.attr('id');
				$( menu_m + ":not(" + arr_i_m + ")" ).removeClass('current-product-ancestor').removeClass('current-menu-parent').removeClass('current-product-parent');
				return false;
			}
		});
		// Sidebar on mobile
		var right_sidebars = '#sns_content .sns-right, #sns_content .sns-right-sidebar, #sns_content .sns-main .inner-sidebar.right, body.archive #sns_content .column-content-box';
		$(right_sidebars).each(function(){
			var right_sd = $(this);
			if(right_sd.length) {
				$('.btn-navbar.rightsidebar').on('click', function(){
					if($(this).hasClass('active')){
						$(this).find('.overlay').fadeOut(250); $(this).removeClass('active');
						right_sd.removeClass('active');
						$('body').removeClass('show-sidebar', 4000);
					} else {
						$(this).addClass('active');
						$(this).find('.overlay').fadeIn();
						right_sd.addClass('active');
						$('body').addClass('show-sidebar');
					}
				});
			}
		});
		var left_sidebars = '#sns_content .sns-left, #sns_content .sns-main .inner-sidebar.left';
		$(left_sidebars).each(function(){
			var left_sd = $(this);
			if(left_sd.length) {
				$('.btn-navbar.leftsidebar').on('click', function(){
					if($(this).hasClass('active')){
						$(this).find('.overlay').fadeOut(250); $(this).removeClass('active');
						left_sd.removeClass('active');
						$('body').removeClass('show-sidebar', 4000);
					} else {
						$(this).addClass('active');
						$(this).find('.overlay').fadeIn();
						left_sd.addClass('active');
						$('body').addClass('show-sidebar');
					}
				});
			}
		});
		$('#sns_mainmenu.main-cat').each(function(){
			var bigcat = $(this);
			if( bigcat ) {
				$('.mini-main-cat').on('click', function(){
					if($(this).hasClass('active')){
						$(this).find('.overlay').fadeOut(250); $(this).removeClass('active');
						bigcat.removeClass('active');
					} else {
						$(this).addClass('active');
						$(this).find('.overlay').fadeIn();
						bigcat.addClass('active');
					}
				});
			}
		});
		// Back to top
		//$('.sns-croll-to-top #sns-totop').hide();
		var wh = $(window).height();
		var whtml =  $(document).height();
		$(window).scroll(function () {
			if ($(this).scrollTop() > whtml/10) {
				$('.sns-croll-to-top #sns-totop').addClass('active');//fadeIn();
			} else {
				$('.sns-croll-to-top #sns-totop').removeClass('active'); //.fadeOut();
			}
		});
		$('.sns-croll-to-top #sns-totop').on( 'click', function() {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		// Count to
		$('.counter-value').each(function(){
			$(this).waypoint(function() {
	        	var element = $(this).find(' > span');
		    	element.countTo({
		    		from: element.data('from'), 
		    		to: element.data('to'),
		    		efreshInterval: element.data('interval'),
		    		speed: element.data('speed')
		    	});
	        },{
			triggerOnce : true ,
			     offset : '100%'
	    	});
		});
		// Time count down
		$('.time-count-down').each(function(){
			if ( $(this).length ) {
	            $(this).find('.clock-digi').countdown($(this).attr('data-date'))
					.on('update.countdown', function(event) {
						var format = '%H:%M:%S';
						if(event.offset.totalDays > 0) {
							$(this).find('.day').html(event.strftime('%D'));
						}else{
							 $(this).find('.day').parent().remove();
						}
						$(this).find('.hours').html(event.strftime('%H'));
		                $(this).find('.minutes').html(event.strftime('%M'));
		                $(this).find('.seconds').html(event.strftime('%S'));
					})
					.on('finish.countdown', function(event) {
						$(this).html('This offer has expired!')
					    	.parent().addClass('hidden');

				});
			}
		});
		$('.search .search-tongle').on('click', function(){
			if( $(this).parents('.search').hasClass('active') ){
				$(this).parents('.search').removeClass('active');
			}else{
				$(this).parents('.search').addClass('active');
			}
		});
		$('.menu-tongle').on('click', function(){
			$(this).addClass('active'); $('.menu-search-content').addClass('active');
		});
		$('.menu-search-content .overlay .bt-close').on('click', function(){
			$('.menu-tongle').removeClass('active'); $('.menu-search-content').removeClass('active');
		});
		function sns_equal_col(){
			var $col_h = 0;
			$('.wpb_row.equal-col > .wpb_column').each(function(){
				var _this_height = $(this).height();
				if( $col_h > 0 && _this_height < $col_h){
					$(this).css( 'min-height', $col_h);
				}else{
					$col_h = _this_height;
				}
			});
		}
		sns_equal_col();
		// On mobile
		function addHoverOnMobile(el){
			if( $(el).length ){
				$(el).mouseover(function(){
					$(el).addClass('hover');
				}).mouseout(function() {
				    $(el).removeClass('hover');
				});
			}
		}
		addHoverOnMobile('.main-header .search-box');
		// Ajax search
		$('.sns-searchwrap').each(function(){
			var sns_useajaxsearch = $(this).attr('data-useajaxsearch');
			var sns_usecat_ajaxsearch  = $(this).attr('data-usecat-ajaxsearch');
			
			if( typeof $.fn.select2 == 'function' && sns_usecat_ajaxsearch == 'true' ){
				$('.sns-ajaxsearchbox select.select-cat').select2();
				$('.sns-ajaxsearchbox').addClass('loaded');
			}
			if (sns_useajaxsearch == 'true') {
				var keywords = '';
				var keywords_old = '';
				var search_timeout;
				var search_inputtext;
				var array_old_result = {};
				$('body').append('<div id="sns_searchresult_wrap"></div>');
				var sns_searchresult_wrap = $('#sns_searchresult_wrap');
				
				$('.sns-searchwrap .search-input input[name="s"]').on('keyup', function(e){
					sns_searchresult_wrap.hide();
					search_inputtext = $(this);
					keywords = $.trim($(this).val());
					// Define keywords length to start ajax
					if( keywords.length < 3 ){
						search_inputtext.parents('.search-input').removeClass('loading');
						return;
					}
					if( array_old_result[keywords] ){
						sns_searchresult_wrap.html(array_old_result[keywords]);
						sns_searchresult_wrap.show();
						keywords_old = '';
						search_inputtext.parents('.search-input').removeClass('loading');
						sns_searchresult_wrap.find('.viewall-result a').on('click', function(e){
							e.preventDefault();
							search_inputtext.parents('form').trigger('submit');
						});
						return;
					}
					
					clearTimeout(search_timeout);
					search_timeout = setTimeout(function(){
						if( keywords == keywords_old || keywords.length < 3 ){
							return;
						}
						keywords_old = keywords;
						search_inputtext.parents('.search-input').addClass('loading');
						// Check category
						var category = '';
						if( sns_usecat_ajaxsearch == 'true' ){
							var select_category = search_inputtext.parents('.search-input').siblings('.select-cat');
							if( select_category.length > 0 ){
								category = select_category.find(':selected').val();
							}
						}
						$.ajax({
							type : 'POST',
							url : ajaxurl,
							data : {action : 'valen_ajax_search', keywords: keywords, category: category},
							error : function(xhr,err){
								search_inputtext.parents('.search-input').removeClass('loading');
							},
							success : function(response){
								if( response != '' ){
									response = JSON.parse(response);
									if( response.keywords == keywords ){
										sns_searchresult_wrap.html(response.html);
										// Set array_old_result
										array_old_result[keywords] = response.html;
										// Set style for result wrap
										var border_width = parseInt(search_inputtext.parent('.search-input').css('border-left-width'));
										var top = search_inputtext.offset().top + search_inputtext.outerHeight(true) + 1;
										
										var width = search_inputtext.outerWidth(true) + border_width;
										var left = Math.ceil(search_inputtext.offset().left) - border_width;
										if( (left + width) > $(window).width() ){
											left = left - (width - search_inputtext.outerWidth(true));
										}
										sns_searchresult_wrap.css({
											'position': 'absolute',
											'top': top-1,
											'left': left,
											'width': width,
											'display': 'block'
										});
										search_inputtext.parents('.search-input').removeClass('loading');
										sns_searchresult_wrap.find('.viewall-result a').on('click', function(e){
											e.preventDefault();
											search_inputtext.parents('form').trigger('submit');
										});
									}
								}else{
									search_inputtext.parents('.search-input').removeClass('loading');
								}
							}
						});
					}, 600);
				});
				// Hide result wrap when hover out or click anything
				sns_searchresult_wrap.mouseover(function(){
					//
				}).mouseleave(function() {
					sns_searchresult_wrap.hide();
				});
				$('body').on('click', function(){
					sns_searchresult_wrap.hide();
				});
				// Change sellect category
				if ( sns_usecat_ajaxsearch == 'true' ){
					$('.sns-ajaxsearchbox select.select-cat').on('change', function(){
						keywords_old = '';
						array_old_result = {};
						$(this).parents('.sns-ajaxsearchbox').find('.search-input input[name="s"]').trigger('keyup');
					});
				}
			}
		});
		// Short code custom heading
		$('.vc_custom_heading.want-span-line').each(function(){
			if ( $(this).length ){
				$(this).wrapInner('<span></span>');
			}
		});
		// Shortcode widget
		$('.want-span-line .widget .widgettitle').each(function(){
			if ( $(this).length ){
				$(this).wrapInner('<span></span>');
			}
		});
		// Comment nava
		if ( $('.sns-comments .navigation .pagination').length && $('.sns-comments .navigation .pagination').html().trim().length == 0 ){
			$('.sns-comments .navigation').remove();
		}
		
		
		// Accordion for category blog
		if( $('.widget_categories ul').length > 0 ) {
			$('.widget_categories ul').SnsAccordion();
		}
		
		// List posts
		if ( $('.sns-list-posts .owl-carousel').length ) {
			$('.sns-list-posts .owl-carousel').each(function(){
				$(this).owlCarousel({
	                items: $(this).data('desktop'),
	                responsive : {
	                    0 : { items: $(this).data('mobilep') },
	                    480 : { items: $(this).data('mobilel') },
	                    768 : { items: $(this).data('tabletp') },
	                    992 : { items: $(this).data('tabletl') },
	                    1200 : { items: $(this).data('tabletl') },
	                    1800 : { items: $(this).data('desktop') }
	                },
	                loop: ( $(this).find('> *').length > $(this).data('desktop') ) ? true : false,
	                nav: true,
	                dots: false
	            });
            });
		}
		// Related post
		if ( $('.post-related .owl-carousel').length ) {
			$('.post-related .owl-carousel').owlCarousel({
                items: 3,
                responsive : {
                    0 : { items: 1},
                    480 : { items: 2 },
                    768 : { items: 2 },
                    992 : { items: 3 },
                    1200 : { items: 3 }
                },
                loop: ( $('.post-related .owl-carousel').find('> *').length > 3 ) ? true : false,
                nav: true,
                dots: false
            });
		}
		// Post gallery
		function sns_post_gallery(){
			$('article.type-post').each(function(){
				if ( $(this).find('.thumb-container').length ) {
					var article_g_id = $(this).attr('id');
		            $('#' + article_g_id + ' .thumb-container').owlCarousel({
		                items: 1,
		                loop:true,
		                nav: true,
                		dots: false
		            });
		        }
			});
		}
		sns_post_gallery();
		// handle-preload
		$('.handle-preload').removeClass('handle-preload');
		
		// products slider preload
		if( $('.sns-products-slider').length > 0 ){
			setTimeout(function(){
				$('.sns-products-slider').addClass('loaded');
			},1100);
		}

		// SNS Preload
		if( $('.sns-preload').length > 0 ){
			setTimeout(function(){
				$('.sns-preload').addClass('sns-loaded');
			},1000);
		}

		
		// blog masonry
		if($('.sns-grid-masonry').length > 0){
			$('.sns-grid-masonry').masonry({
				// options
				itemSelector: '.sns-grid-item',
			});
		}
		
		
	});
		
	$(window).load(function(){
		// SNS Carousel shortcode
		$('.sns-carousel').each(function(){
			if ( $(this).length > 0 && $(this).find('.carousel-content').length > 0 ){
				if ( $(this).attr('data-type') == 'h-c' ) { 
					$(this).find('.carousel-content').removeClass('hidden');
					$(this).find('.carousel-content').slick({
						centerMode: true,
						centerPadding: '25%',
						slidesToShow: 1,
						infinite: true,
						slidesToScroll: 1,
						arrows: ($(this).attr('data-nav') == 1) ? true : false,
						autoplay: ( $(this).attr('data-autoplay') == 1 ) ? true : false, 
						autoplayHoverPause: true, autoplaySpeed: 6000,
						responsive: [
							{
						      breakpoint: 1420,
						      settings: {
						        centerPadding: '20%',
						      }
						    },
						    {
						      breakpoint: 778,
						      settings: {
						        arrows: false,
						        centerPadding: '15%',
						      }
						    },
						    {
						      breakpoint: 448,
						      settings: {
						        arrows: false,
						        centerPadding: '0',
						      }
						    }
						]
					});
					$(this).find('.slick-prev').html($(this).attr('data-prev'));
					$(this).find('.slick-next').html($(this).attr('data-next'));
				}else if ( $(this).attr('data-type') == 'h-s' ) {
					var $i = 0, $dotimg = [], $c_uq = '';
					$c_uq = $(this).attr('data-uq');
					$(this).find('.carousel-content > div').each(function(){
						$dotimg[$i] = $(this).attr('data-dotimg');
						$i++;
					});
					if ( typeof $dotimg !== 'undefined' && $dotimg.length > 0 ) {
						$(this).append( "<div class='slider-nav-wrap'><div class='slider-nav'></div></div>" );
						for (var $j = 0; $j < $dotimg.length; $j++) {
							$(this).find('.slider-nav').append( "<div class='dot-img'><img src='"+$dotimg[$j]+"' /></div>" );
						}
						$(this).find('.carousel-content').removeClass('hidden');
						$(this).find('.carousel-content').slick({
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							adaptiveHeight: true,
							fade: true,
							asNavFor: '.slider-nav',
							autoplay: ( $(this).attr('data-autoplay') == 1 ) ? true : false, 
							autoplayHoverPause: true, autoplaySpeed: 6000,
							
						});
						$(this).find('.slider-nav').slick({
							slidesToShow: 5,
							slidesToScroll: 1,
							asNavFor: '.carousel-' + $c_uq + ' .carousel-content',
							centerMode: true,
							focusOnSelect: true,
							arrows: false,
							responsive: [
							    {
							      breakpoint: 668,
							      settings: {
							        slidesToShow: 3,
							      }
							    },
							]
							
						});
					}
				}else if ( $(this).attr('data-type') == 'v' ) {
					$(this).find('.carousel-content').slick({
						vertical: true,
						infinite: true,
						slidesToScroll: 1,
						slidesToShow: $(this).attr('data-desktop'),
						arrows: ($(this).attr('data-nav') == 1) ? true : false,
						autoplay: ( $(this).attr('data-autoplay') == 1 ) ? true : false, 
						autoplayHoverPause: true, autoplaySpeed: 6000,
					});
				} else {
					var c_param = {
						loop: ( $(this).find('.carousel-content').find('> *').length > $(this).data('desktop')) ? true : false,
						dots: ($(this).data('paging') == 1) ? true : false,
						nav: ($(this).data('nav') == 1) ? true : false,
						autoplay: ( $(this).attr('data-autoplay') == 1 ) ? true : false, 
						autoplayHoverPause: true,
		                autoHeight: true,
					    items : $(this).data('desktop'),
		                responsive : {
		                    0 : { items: $(this).data('mobilep') },
		                    480 : { items: $(this).data('mobilel') },
		                    768 : { items: $(this).data('tabletp') },
		                    992 : { items: $(this).data('tabletl') },
		                    1200 : { items: $(this).data('tabletl') },
		                    1800 : { items: $(this).data('desktop') }
		                }
		            }
					$(this).find('.carousel-content').owlCarousel(c_param);
				}
			}
		});
		// Instagram
		if ( $('.sns-instagram .owl-carousel').length ) {
			clearTimeout(instagram_carousel);
			var instagram_carousel = setTimeout(function(){
				$('.sns-instagram .owl-carousel').each(function(){
					$(this).owlCarousel({
		                items: $(this).data('desktop'),
		                responsive : {
		                    0 : { items: $(this).data('mobilep') },
		                    480 : { items: $(this).data('mobilel') },
		                    768 : { items: $(this).data('tabletp') },
		                    992 : { items: $(this).data('tabletl') },
		                    1200 : { items: $(this).data('tabletl') },
		                    1800 : { items: $(this).data('desktop') }
		                },
		                loop: ( $(this).find('> *').length > $(this).data('desktop') ) ? true : false,
		                nav: true,
		                dots: false
		            });
	            });
	        },800);
		}
		// Tooltip
	    $("body.use-tooltip *[data-toggle='tooltip']").each(function(){
			$(this).tooltip({
	    		container: 'body'
	    	}, 'show');
		});
		$("body:not(.use-tooltip) *[data-toggle='tooltip']").each(function(){
			$(this).tooltip({
	    		container: 'body'
	    	}, 'show');
		});
		$(document).ajaxComplete(function(){
			$("body.use-tooltip *[data-toggle='tooltip']").each(function(){
				$(this).tooltip({
		    		container: 'body'
		    	});
			});
			
			// For Search in header style 3
			if ( $('#sns_header .mini-search').length && $('#sns_searchresult_wrap').length ){
				$('#sns_searchresult_wrap').mouseover(function(){
					$('#sns_header .mini-search').addClass('active');
				}).mouseout(function() {
				    $('#sns_header .mini-search').removeClass('active');
				});
			}
		});
		if ( $('#sns_searchresult_wrap').length ){
			$('#sns_searchresult_wrap').mouseover(function(){
				$('#sns_mainnav .sns-searchwrap').addClass('active');
			}).mouseout(function() {
			    $('#sns_mainnav .sns-searchwrap').removeClass('active');
			});
		}
	});

	$.fn.SnsAccordion = function(options) {
		var $el    = $(this);
		var defaults = {
			active: 'open',
			active_default: ['current-menu-item', 'current-menu-ancestor', 'current-cat'], // string or array
			el_wrap: 'li',
			el_content: 'ul',
			accordion: true,
			expand: true,
			btn_open: '<i class="fa fa-chevron-down"></i>',
			btn_close: '<i class="fa fa-chevron-up"></i>'
		};
		var options = $.extend({}, defaults, options);
		
		$el.find(options.el_wrap).each(function(){
			$(this).find('> a, > span, > h4').wrap('<div class="accr_header"></div>');
			if(($(this).find(options.el_content)).length){
				$(this).find('> .accr_header').append('<span class="btn_accor">' + options.btn_open + '</span>');
				$(this).find('> '+options.el_content+':not(".accr_header")').wrap('<div class="accr_content"></div>');
			}
		});
		if(options.accordion){
			$('.accr_content').hide();
			$el.find(options.el_wrap).each(function(){
				var $this_el_wrap = $(this);
				var $active_d = options.active_default;
				if ( Array.isArray($active_d) ) {
					for (var i = 0; i < $active_d.length; i++) {
					    if( $active_d[i] !=='' ){
							if( $this_el_wrap.hasClass( $active_d[i] ) ){
								$this_el_wrap.find('> .accr_content').addClass(options.active).slideDown();
								$this_el_wrap.find('> .accr_header').addClass(options.active);
								$this_el_wrap.find('> .accr_header .btn_accor').html(options.btn_close);
								break;
							}
						}
					}
				} else {
					if(options.active_default!==''){
						if( $this_el_wrap.hasClass($(this)) ){
							$this_el_wrap.find('> .accr_content').addClass(options.active).slideDown();
							$this_el_wrap.find('> .accr_header').addClass(options.active);
							$this_el_wrap.find('> .accr_header .btn_accor').html(options.btn_close);
						}
					}
				}
			});
			$('.accr_content.open').slideDown();
		} else {
			$el.find(options.el_wrap).each(function(){
				if(!options.expand){
					$('.accr_content').hide();
				} else {
					$(this).find('> .accr_content').addClass(options.active);
					$(this).find('> .accr_header').addClass(options.active);
					$(this).find('> .accr_header .btn_accor').html(options.btn_close);
					$('.accr_content.open').slideDown();
				}
			});
		}
		$el.find(options.el_wrap).each(function(){
			var $wrap = $(this);
			var $accrhead = $wrap.find('> .accr_header');
			var btn_accor = '.btn_accor';
			
			$accrhead.find(btn_accor).on('click', function(event) {
				event.preventDefault();
				var obj = $(this);
				var slide = true;
				if($accrhead.hasClass(options.active)) {
					slide = false;
				}
				if(options.accordion){
					$wrap.siblings(options.el_wrap).find('> .accr_content').slideUp().removeClass(options.active);
					$wrap.siblings(options.el_wrap).find('> .accr_header').removeClass(options.active);
					$wrap.siblings(options.el_wrap).find('> .accr_header ' + btn_accor).html(options.btn_open);
				}
				if(slide) {
					$accrhead.addClass(options.active);
					obj.html(options.btn_close);
					$accrhead.siblings('.accr_content').addClass(options.active).stop(true, true).slideDown();
				} else {
					$accrhead.removeClass(options.active);
					obj.html(options.btn_open);
					$accrhead.siblings('.accr_content').removeClass(options.active).stop(true, true).slideUp();
				}
				return false;
			});
		});
		$el.addClass('handled');
	};  

	 // Top header toggle menu
    if($('#sns_header.style2 .icon-menu').length > 0){
    	$('#sns_header.style2 .icon-menu').on('click', function(event){
    		
    		event.preventDefault();
    		var _this = $(this);
    		if(_this.hasClass('close')){
    			_this.removeClass('close');
    			$('.sns-mainnav-wrapper #sns_mainmenu').addClass('open');
    			$('.menu-text').addClass('hid');
    		}else{
    			_this.addClass('close');
    			$('.sns-mainnav-wrapper #sns_mainmenu').removeClass('open');
    			$('.menu-text').removeClass('hid');
    		}
    	});
    }

    // cpanel
	$('#sns_cpanel #sns_cpanel_btn .view-demo, #sns_cpanel + .overlay').on('click', function() {
		if( $('#sns_tools #sns_cpanel').hasClass('open') ){
			$('#sns_tools #sns_cpanel').removeClass('open');
		}else{
			$('#sns_tools #sns_cpanel').addClass('open');
		}
		return false;
	});

})(jQuery);