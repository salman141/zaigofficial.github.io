# Icelander Changelog

## 1.5.5, 20201116

### Update
- Update notifier
- Improving intro excerpt text to prevent issues with plugins such as WPML

### Fix
- Color contrast on skip links
- Project Layout template working with block editor (picking up the gallery from the content correctly)
- Styling bugs

### File updates
	changelog.md
	readme.txt
	style.css
	assets/scss/_css-vars.scss
	assets/scss/custom-styles-woocommerce.scss
	assets/scss/main.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize.php
	includes/frontend/class-post-summary.php
	includes/frontend/class-post.php
	includes/update-notification/class-update-notification.php
	library/includes/classes/class-css-variables.php
	templates/parts/intro/intro-content.php


## 1.5.4

* **Fix**: Call To Action page builder module throwing PHP error

### Files changed:

	changelog.md
	readme.txt
	style.css
	includes/plugins/webman-amplifier/class-webman-amplifier-shortcodes.php


## 1.5.3

* **Update**: Adding `nofollow` attribute to default site info links
* **Update**: Theme options info
* **Update**: Removing Elementor affiliate
* **Update**: Localization
* **Fix**: Removing post excerpt wrapper when excerpt is empty

### Files changed:

	changelog.md
	readme.txt
	style.css
	includes/customize/class-customize.php
	includes/frontend/class-post-summary.php
	includes/plugins/elementor/class-elementor.php
	languages/*.*
	templates/parts/footer/site-info.php


## 1.5.2

* **Add**: Adding WhatsApp and Google social icon
* **Update**: Implementing WordPress 5.2 code updates
* **Fix**: Preventing PHP error after theme activation

### Files changed:

	changelog.md
	header.php
	readme.txt
	style.css
	assets/images/svg/social-icons.svg
	includes/frontend/class-header.php
	includes/frontend/class-menu.php
	includes/setup/class-setup.php
	templates/parts/admin/welcome-demo.php
	templates/parts/admin/welcome-footer.php
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-quickstart.php
	templates/parts/admin/welcome-wordpress.php


## 1.5.1

* **Update**: Removing obsolete code
* **Update**: Code notes, formatting and version numbers
* **Fix**: Elementor Theme Builder compatibility
* **Fix**: "Continue reading" broken HTML for posts with more tag

### Files changed:

	changelog.md
	readme.txt
	style.css
	includes/frontend/class-post-summary.php
	includes/plugins/elementor/class-elementor.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	templates/parts/admin/welcome-header.php
	templates/parts/content/content-child-page.php
	templates/parts/content/content-project.php
	templates/parts/content/content-staff.php


## 1.5.0

* **Add**: Elementor Pro Theme Builder compatibility
* **Add**: Theme options to edit home page intro overlay colors and opacity
* **Update**: Custom typography info in theme options
* **Update**: Styles
* **Update**: Welcome page and notice
* **Update**: Improving Beaver Themer compatibility
* **Update**: Updating info about demo require plugins
* **Update**: Improving CSS variables functionality for browsers with no support
* **Update**: Navigation accessibility and touch screen functionality
* **Update**: Improving accessibility skip links
* **Update**: Improving intro image accessibility
* **Update**: Updating excerpts display
* **Update**: Improving Recent Posts widget enhancement
* **Update**: Improving code
* **Update**: Improving security
* **Update**: Localization

### Files changed:

	changelog.md
	footer.php
	functions.php
	header.php
	readme.txt
	style.css
	assets/js/scripts-navigation-accessibility.js
	assets/scss/_css-vars.scss
	assets/scss/_setup.scss
	assets/scss/custom-styles-editor.scss
	assets/scss/custom-styles-woocommerce.scss
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/print.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-footer.php
	includes/frontend/class-header.php
	includes/frontend/class-menu.php
	includes/frontend/class-post-summary.php
	includes/frontend/class-post.php
	includes/plugins/bb-header-footer/class-bb-header-footer.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/elementor/class-elementor.php
	includes/plugins/elementor/elementor.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/setup/class-setup.php
	includes/welcome/class-welcome.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/*.*
	library/includes/classes/class-admin.php
	library/includes/classes/class-core.php
	library/includes/classes/class-css-variables.php
	library/includes/classes/class-customize-control-multiselect.php
	library/includes/classes/class-customize-control-radio-matrix.php
	library/includes/classes/class-customize-control-select.php
	library/includes/classes/class-customize.php
	library/scss/customize.scss
	library/scss/welcome.scss
	library/scss/styles/_customize.scss
	library/scss/styles/_welcome.scss
	templates/parts/admin/welcome-footer.php
	templates/parts/component/link-more-product.php
	templates/parts/component/link-more.php
	templates/parts/content/content-child-page.php
	templates/parts/content/content.php
	templates/parts/header/links-skip.php
	templates/parts/intro/intro-content.php
	templates/parts/meta/entry-meta-element-comments.php
	templates/parts/meta/entry-meta-element-date.php


## 1.4.1

* **Fix**: RTL language layout styles

### Files changed:

	changelog.md
	readme.txt
	style.css
	assets/scss/main-rtl.scss


## 1.4.0

* **Add**: WP Subtitle plugin compatibility
* **Update**: Support URL
* **Update**: Improving code
* **Update**: Improving security
* **Update**: Adding WPCS comments to code
* **Update**: `.screen-reader-text` CSS class styles
* **Update**: Improving customizer functionality
* **Update**: Using CSS variables instead of generating customized stylesheet
* **Update**: Removing obsolete functionality
* **Update**: Updating readme file
* **Update**: Setting `use strict` in JavaScript
* **Update**: Removing all `locate_template()` function references
* **Update**: Removing CSS minification in favor of plugins
* **Update**: Improving accessibility
* **Update**: Removing Smart Slider 3 code
* **Update**: Removing archive page title modifications in favor of Archive Title plugin
* **Update**: Localization
* **Update**: Documentation

### Files changed:

	changelog.md
	functions.php
	readme.txt
	style.css
	assets/js/customize-preview.js
	assets/js/scripts-beaver-builder-editor.js
	assets/js/scripts-global.js
	assets/js/scripts-masonry.js
	assets/js/scripts-navigation-accessibility.js
	assets/js/scripts-navigation-mobile.js
	assets/js/scripts-widget-text.js
	assets/js/scripts-woocommerce.js
	assets/js/skip-link-focus-fix.js
	assets/scss/_css-vars.scss
	assets/scss/main.scss
	assets/scss/shortcodes.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/_starter.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/frontend/class-menu.php
	includes/frontend/class-post-media.php
	includes/frontend/class-post.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/plugins/subtitles/class-subtitles.php
	includes/plugins/subtitles/subtitles.php
	includes/plugins/webman-amplifier/class-webman-amplifier-icons.php
	includes/plugins/webman-amplifier/class-webman-amplifier-shortcodes.php
	includes/plugins/woocommerce/class-woocommerce-assets.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/plugins/woocommerce/class-woocommerce-wrappers.php
	includes/setup/class-setup.php
	includes/tgmpa/class-tgmpa-plugins.php
	includes/welcome/class-welcome.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/*.*
	library/init.php
	library/includes/classes/class-admin.php
	library/includes/classes/class-core.php
	library/includes/classes/class-css-variables.php
	library/includes/classes/class-customize-control-html.php
	library/includes/classes/class-customize-control-multiselect.php
	library/includes/classes/class-customize-control-radio-matrix.php
	library/includes/classes/class-customize-control-select.php
	library/includes/classes/class-customize.php
	library/includes/classes/class-sanitize.php
	library/js/customize-control-multicheckbox.js
	library/js/customize-control-radio-matrix.js
	library/js/customize-controls.js
	library/js/post.js
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-quickstart.php
	templates/parts/header/site-branding.php
	templates/parts/intro/intro-content.php
	templates/parts/menu/menu-social.php
	templates/parts/meta/entry-meta-element-category.php
	templates/parts/meta/entry-meta-element-comments.php
	templates/parts/meta/entry-meta-element-tags.php
	webman-amplifier/content-shortcode-posts-post.php
	webman-amplifier/content-shortcode-posts-wm_projects.php
	webman-amplifier/content-shortcode-posts-wm_staff.php


## 1.3.4

* **Add**: More social icons
* **Update**: WordPress 5.0 ready
* **Update**: Loading Genericons Neue as separate stylesheet
* **Update**: Advanced Custom Fields plugin compatibility
* **Update**: Beaver Themer plugin compatibility
* **Update**: Removing obsolete `locate_template()`
* **Fix**: Making social icons menu multilingual ready
* **Fix**: Compatibility with Beaver Builder 2.2
* **Fix**: SSL URLs

### Files changed:

	changelog.md
	functions.php
	style.css
	assets/fonts/genericons-neue/*.*
	assets/images/svg/social-icons.svg
	assets/scss/main.scss
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/frontend/class-menu.php
	includes/frontend/class-svg.php
	includes/plugins/advanced-custom-fields/advanced-custom-fields.php
	includes/plugins/advanced-custom-fields/class-advanced-custom-fields.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-column.php
	includes/plugins/beaver-builder/class-beaver-builder-row.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/tgmpa/class-tgmpa-plugins.php
	library/init.php
	library/includes/classes/class-visual-editor.php
	templates/parts/header/site-branding.php
	templates/parts/menu/menu-social.php
	webman-amplifier/content-shortcode-posts-post.php
	webman-amplifier/content-shortcode-posts-wm_projects.php
	webman-amplifier/content-shortcode-posts-wm_staff.php


## 1.3.3

* **Fix**: Blog page intro image
* **Fix**: Blog page excerpt
* **Fix**: Content indentation in page excerpt field when using Rich Text Excerpt plugin

### Files changed:

	changelog.md
	style.css
	includes/custom-header/class-intro.php
	includes/frontend/class-header.php
	templates/parts/intro/intro-content.php


## 1.3.2

* **Update**: Removing obsolete `role` HTML attributes
* **Fix**: RTL stylesheets loading

### Files changed:

	changelog.md
	sidebar-footer-secondary.php
	sidebar-footer.php
	sidebar-header.php
	sidebar-intro.php
	sidebar-product.php
	sidebar-shop-before.php
	sidebar.php
	style.css
	includes/frontend/class-assets.php
	includes/frontend/class-content.php
	includes/frontend/class-footer.php
	includes/frontend/class-header.php
	templates/parts/menu/menu-primary.php


## 1.3.1

* **Update**: Preventing Beaver Builder color presets JS error
* **Fix**: Inline styles loading
* **Fix**: "Recent Posts" widget categories field label text
* **Fix**: Editor fallback stylesheets loading

### Files changed:

	changelog.md
	style.css
	includes/frontend/class-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/widgets/class-wp-widget-recent-posts.php


## 1.3.0

* **Add**: New update notification functionality
* **Update**: Removing documentation folder in favor of online docs
* **Update**: Improved categories selector in enhanced Recent Posts widget
* **Update**: Localization
* **Fix**: Masonry layout not applied on archive pages
* **Fix**: WooCommerce product variation select not working in Firefox browser
* **Fix**: All NS Theme Check plugin test errors
* **Fix**: All Envato Theme Check plugin test requirements
* **Fix**: iOS device buttons double tap issue
* **Fix**: Jetpack Author Bio display

### Files changed:

	changelog.md
	development.md
	functions.php
	style.css
	assets/js/scripts-masonry.js
	assets/scss/editor-style.scss
	assets/scss/main.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize-styles.php
	includes/frontend/class-assets.php
	includes/frontend/class-post.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-assets.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/update-notification/class-update-notification.php
	includes/widgets/class-wp-widget-recent-posts.php
	languages/*.*
	library/includes/classes/class-customize-control-multiselect.php
	library/includes/classes/class-customize-control-select.php
	webman-amplifier/content-shortcode-posts-post.php
	webman-amplifier/content-shortcode-posts-wm_projects.php
	webman-amplifier/content-shortcode-posts-wm_staff.php


## 1.2.0

* **Add**: WooCommerce masonry products layout when product images are set to "uncropped"
* **Update**: WordPress 4.9.6 compatibility (GDPR)
* **Update**: Improved custom widget enhancements
* **Update**: Beaver Builder compatibility
* **Update**: WooCommerce compatibility
* **Update**: Localization
* **Fix**: Beaver Builder row width

### Files changed:

	changelog.md
	style.css
	assets/js/scripts-masonry.js
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/_starter.scss
	includes/frontend/class-header.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-form.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	languages/*.*
	templates/parts/footer/site-info.php


## 1.1.9

* **Fix**: Backwards compatibility with Beaver Builder pre-2.1

### Files changed:

	changelog.md
	style.css
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-themer/class-beaver-themer.php


## 1.1.8

* **Fix**: Compatibility with Beaver Builder 2.1+
* **Fix**: Beaver Themer post preview selector not working
* **Fix**: Jetpack Infinite Scroll compatibility issue
* **Fix**: Back to top button accessibility
* **Fix**: Possible minor horizontal scroll on mobile devices
* **Fix**: Preventing PHP error when WooCommerce shop page is not set

### Files changed:

	changelog.md
	style.css
	assets/js/scripts-global.js
	assets/scss/main.scss
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-themer/class-beaver-themer.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	templates/parts/loop/loop.php


## 1.1.7

* **Fix**: Hiding WooCommerce 3.3 search form submit button
* **Fix**: WooCommerce cart cross-sells layout

### Files changed:

	changelog.md
	style.css
	assets/scss/custom-styles-editor.scss
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	includes/customize/class-customize.php


## 1.1.6

* **Fix**: WooCommerce 3.3- backwards compatibility

### Files changed:

	changelog.md
	style.css
	includes/plugins/woocommerce/class-woocommerce-loop.php


## 1.1.5

* **Add**: Compatibility with WooCommerce 3.3 product grid options
* **Update**: Hiding post meta on paginated/parted single post
* **Update**: Not disabling Jetpack sharing buttons on page builder posts/pages (leaving this to Jetpack per-post option)
* **Update**: Improving headings structure
* **Update**: Documentation
* **Fix**: WooCommerce 3.3 pagination issue
* **Fix**: Jetpack Author Bio box styles
* **Fix**: Post tags list styles
* **Fix**: Single post meta display when page builder is used
* **Fix**: Single post intro media responsive RTL styles
* **Fix**: Recent Posts widget "Continue reading" link URL

### Files changed:

	changelog.md
	comments.php
	sidebar-product.php
	sidebar.php
	style.css
	assets/scss/main.scss
	assets/scss/woocommerce.scss
	documentation/documentation.html
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-loop.php
	includes/frontend/class-sidebar.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/plugins/woocommerce/class-woocommerce-widgets.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	templates/parts/component/breadcrumbs.php
	templates/parts/loop/loop-categories-product.php
	templates/parts/menu/menu-footer.php
	templates/parts/menu/menu-primary.php
	templates/parts/menu/menu-secondary.php
	templates/parts/menu/menu-social.php

## 1.1.4

* **Update**: Future proofing custom Text widget enhancement
* **Update**: Post meta styles on single post pages
* **Update**: Media player styles

### Files changed:

	changelog.md
	style.css
	assets/scss/main.scss
	includes/widgets/class-wp-widget-text.php


## 1.1.3

* **Add**: Jetpack Content Options compatibility
* **Add**: Displaying post category and tags on single post page (compatible with Jetpack Content Options)
* **Update**: WordPress 4.9 compatible
* **Update**: Improved stylesheets loading
* **Update**: Improving WebMan Amplifier compatibility
* **Update**: Improving Beaver Builder compatibility
* **Update**: Theme documentation URL
* **Update**: Minor styles updates and fixes
* **Update**: Library 2.5.6, Starter CSS 3.16.0
* **Update**: Localization
* **Fix**: Author archive layout

### Files changed:

	changelog.md
	functions.php
	style.css
	assets/css-generate/generate-css-editor-rtl.php
	assets/css-generate/generate-css-editor.php
	assets/css-generate/generate-css-rtl.php
	assets/css-generate/generate-css.php
	assets/scss/_setup.scss
	assets/scss/beaver-builder-editor.scss
	assets/scss/main.scss
	assets/scss/starter/*.*
	includes/custom-header/class-intro.php
	includes/customize/class-customize-styles.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/frontend/class-post-media.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/plugins/webman-amplifier/class-webman-amplifier-shortcodes.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/setup/class-setup.php
	includes/tgmpa/class-tgmpa-plugins.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	languages/*.*
	library/*.*
	templates/parts/admin/welcome-demo.php
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-wordpress.php
	templates/parts/meta/entry-meta.php


## 1.1.2

* **Update**: WebMan Amplifier plugin compatibility

### Files changed:

	changelog.md
	style.css
	documentation/documentation.html
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/tgmpa/class-tgmpa-plugins.php


## 1.1.1

* **Add**: Filter hook for pagination settings
* **Update**: Responsive comments and WooCommerce reviews styles
* **Update**: Improving post type page templates
* **Update**: Improving accessibility styles
* **Update**: CSS Starter 3.15.0
* **Fix**: Minor style fixes
* **Fix**: Mobile menu accessibility
* **Fix**: WooCommerce 3.2 compatibility
* **Fix**: WooCommerce category title styles when intro is disabled
* **Fix**: WooCommerce endpoint titles not being applied

### Files changed:

	changelog.md
	comments.php
	style.css
	assets/scss/main.scss
	assets/scss/starter/_starter.scss
	includes/frontend/class-loop.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-single.php
	templates/intro-widgets.php
	templates/no-intro.php
	templates/project-layout.php


## 1.1.0

* **Add**: Genericons styles (the actual icons)
* **Add**: Loading WebMan Amplifier icons into TineMCE (so they correctly display as custom list bullets, for example)
* **Add**: Pingbacks and trackbacks styles
* **Update**: Making the theme more compatible with WordPress.org theme requirements
* **Update**: Improving WooCommerce code
* **Update**: Advanced Custom Fields: Improving custom metaboxes setup
* **Update**: Library 2.4.1, CSS Starter 3.14.4
* **Update**: Making custom Text widget enhancement work with any icon CSS classes
* **Update**: Preventing main stylesheet browser caching on customizer update
* **Update**: Simplifying accessibility link styles for better overriding with custom CSS
* **Update**: Removing theme installation actions (presetting theme options)
* **Update**: Removing WordPress image sizes overriding on theme activation (in favor of a simple notification)
* **Update**: Improving sidebars descriptions
* **Update**: Removing obsolete stylesheet regeneration admin notification
* **Update**: Using default WordPress navigation fallback (list of pages)
* **Update**: Theme default footer credits text
* **Update**: Gallery styles
* **Update**: Customizer checkbox options logic made consistent with WordPress native ones (checked = enabled) (affecting "Archive page title prefix", "Mobile navigation" and "Footer background image repeat" options!)
* **Update**: Display text sizes according to typographic scale
* **Update**: Improving styles
* **Update**: Styling `.icon` and `.icon-bullet` CSS classes
* **Update**: Stretching post featured image over the post container border
* **Update**: Adding post update date to post meta info
* **Update**: Accessibility styles
* **Update**: WooCommerce Recent Reviews widget styles
* **Update**: Removing product subtitle in WooCommerce product reviews
* **Update**: Not displaying archive page description on paginated pages
* **Update**: Localization
* **Update**: Documentation
* **Fix**: Displaying media on attachment page
* **Fix**: Typos
* **Fix**: WooCommerce minor style issues
* **Fix**: WooCommerce product gallery columns count
* **Fix**: TinyMCE "Formats" dropdown button styles
* **Fix**: Mobile menu toggle styles
* **Fix**: HTML in post title not displayed in intro area
* **Fix**: Ordered list styles in a post comment
* **Fix**: Minor TinyMCE editor styles issues
* **Fix**: Recent Posts widget styles when displayed in post/page content
* **Fix**: WooCommerce Tagcloud widget styles
* **Fix**: WooCommerce cart page styles
* **Fix**: Widgets CSS Classes plugin options overriding

### Files changed:

	archive.php
	changelog.md
	comments.php
	functions.php
	style.css
	assets/css-generate/custom-styles.php
	assets/js/scripts-global.js
	assets/js/scripts-widget-text.js
	assets/scss/beaver-builder-editor.scss
	assets/scss/custom-styles-editor.scss
	assets/scss/custom-styles-woocommerce.scss
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/options-widget-text.scss
	assets/scss/shortcodes.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/*.*
	documentation/documentation.html
	documentation/sass/docs.scss
	includes/custom-header/class-intro.php
	includes/customize/class-customize.php
	includes/frontend/class-assets.php
	includes/frontend/class-header.php
	includes/frontend/class-loop.php
	includes/frontend/class-menu.php
	includes/frontend/class-post-media.php
	includes/frontend/class-post-summary.php
	includes/frontend/class-post.php
	includes/frontend/class-sidebar.php
	includes/plugins/advanced-custom-fields/class-advanced-custom-fields.php
	includes/plugins/beaver-builder/beaver-builder.php
	includes/plugins/beaver-builder/class-beaver-builder-assets.php
	includes/plugins/beaver-builder/class-beaver-builder-setup.php
	includes/plugins/jetpack/class-jetpack.php
	includes/plugins/one-click-demo-import/class-one-click-demo-import.php
	includes/plugins/subtitles/class-subtitles.php
	includes/plugins/webman-amplifier/webman-amplifier.php
	includes/plugins/widget-css-classes/class-widget-css-classes.php
	includes/plugins/woocommerce/class-woocommerce-customize.php
	includes/plugins/woocommerce/class-woocommerce-helpers.php
	includes/plugins/woocommerce/class-woocommerce-loop.php
	includes/plugins/woocommerce/class-woocommerce-pages.php
	includes/plugins/woocommerce/class-woocommerce-setup.php
	includes/plugins/woocommerce/class-woocommerce-single.php
	includes/plugins/woocommerce/class-woocommerce-widgets.php
	includes/plugins/woocommerce/class-woocommerce-wrappers.php
	includes/plugins/woocommerce/woocommerce.php
	includes/setup/class-setup.php
	includes/tgmpa/class-tgmpa-plugins.php
	includes/widgets/class-wp-widget-recent-posts.php
	includes/widgets/class-wp-widget-text.php
	languages/icelander.pot
	languages/sk_SK.mo
	languages/sk_SK.po
	library/*.*
	templates/parts/admin/media-image-sizes.php
	templates/parts/admin/welcome-demo.php
	templates/parts/admin/welcome-filesystem.php
	templates/parts/admin/welcome-header.php
	templates/parts/admin/welcome-quickstart.php
	templates/parts/admin/welcome-wordpress.php
	templates/parts/footer/site-info.php
	templates/parts/intro/intro-content.php
	templates/parts/intro/intro-media.php
	templates/parts/menu/menu-primary.php
	templates/parts/meta/entry-meta-element-date.php


## 1.0.1

* **Update**: Improving accessibility
* **Update**: Library v2.2.7, Starter CSS v3.13.0
* **Fix**: Widgets CSS Classes plugin PHP error

### Files changed:

	changelog.md
	style.css
	assets/scss/custom-styles.scss
	assets/scss/main.scss
	assets/scss/shortcodes.scss
	assets/scss/woocommerce.scss
	assets/scss/starter/*.*
	includes/plugins/webman-amplifier/class-webman-amplifier-shortcodes.php
	includes/plugins/widget-css-classes/class-widget-css-classes.php
	library/*.*


## 1.0.0

* Initial release.
