// Regex pattern for cathing vh-based value
var vhPattern       = / \d+vh/;
var vhPatternGlobal = / \d+vh/g;


(function ($) {
  var blockId         = ETBlockLayoutPreview.blockId;
  var finalAdjustment = false;

  // Vh-unit adjustment
  var etBlockLayoutPreviewVhAdjustment = {
    vhStylesArray: [],
    vhStyles: '',
    styleId: 'et-block-layout-preview-overwrite-vh-style',

    /**
     * Initialize vh adjustment mechanism for layout preview. Look for all vh-based value added
     * to the document whether it is internal or external stylesheet, compile it for listener
     * reference so value can be updated on resize event, then append style on the bottom of body.
     * Note: builder has vh-based issue as well due to how it is loaded but address this issue
     * differently (external style being overwritten then listened while builder-based value is
     * modified on the fly).
     *
     * @since 4.1.0
     *
     * @see setupOnloadVhBasedStyling()
     * @see adjustVhBasedStyling()
     */
    init: function () {
      // If styling has been populated, bail. This method assumes that all styling has been rendered
      // on page load and no additional styling is added as the page is being rendered
      if (this.vhStylesArray.length > 0) {
        return;
      }

      // Populate selector & property which uses vh-based value
      var vhCssArray = [];

      // Get property which uses vh based value
      var getVhPropsBasedOnCssRule = function(cssRule) {
        var vhCss = [];

        // Populate properties that used vh-based unit
        var vhCssProperties = [];

        // Loop style's property and look for property which uses vh-unit value
        if ('string' === typeof cssRule.style.cssText) {
          $(cssRule.style.cssText.split(';')).each(function (propertyIndex, property) {
            if (vhPattern.test(property)) {
              vhCssProperties.push(property.trim() + ';');
            }
          });
        }

        // Push selector and valid properties if there's any
        if (vhCssProperties.length > 0) {
          var vhDeclaration = cssRule.selectorText + '{' + vhCssProperties.join(' ') + '}';

          vhCss.push(vhDeclaration);
        }

        return vhCss;
      }

      // Get all stylesheet used on the page then loop it. No lodash, so use jQuery's `each()`
      $(document.styleSheets).each(function (index, stylesheet) {
        try {
          $(stylesheet.cssRules).each(function (cssRulesIndex, cssRule) {

            // Check if current style has vh-based unit
            if (cssRule.selectorText && vhPattern.test(cssRule.cssText)) {
              vhCssArray = vhCssArray.concat(getVhPropsBasedOnCssRule(cssRule));
            }

            // CSSMediaList has no selectorText, so it'll definitely missed the first check
            if (cssRule.media && vhPattern.test(cssRule.cssText)) {
              var mediaQueryVhCssArray = [];

              // Loop for cssRules and capture selector which uses vh-based value
              $(cssRule.cssRules).each(function(mediaCssRuleIndex, mediaCssRule) {
                mediaQueryVhCssArray = mediaQueryVhCssArray.concat(getVhPropsBasedOnCssRule(mediaCssRule));
              });

              vhCssArray = vhCssArray.concat(['@media ' + cssRule.conditionText + ' {' + mediaQueryVhCssArray.join(' ') + '}']);
            }

          });
        } catch (error) {
          // External CSS that doesn't have rules element (ie. Google Font style) might throw
          // error and block the whole process
        }
      });

      // Set as reference
      this.vhStylesArray = vhCssArray;
      this.vhStyles      = vhCssArray.join(' ');

      // Append style to the bottom of the body so existing vh-based style will be overwritten
      $('<style>', {
        id: this.styleId
      })
      .html(this.getStyles())
      .appendTo('body');
    },

    /**
     * Get styling which uses vh-based value converted to px unit
     *
     * @since 4.1.0
     *
     * @return {string}
     */
    getStyles: function() {
      var styles                  = this.vhStyles;
      var editorWindow            = window.top || window;
      var $blockEditorHeader      = window.top.jQuery('.edit-post-header');
      var blockEditorHeaderHeight = $blockEditorHeader.outerHeight();
      var windowHeight            = $(editorWindow).height() - blockEditorHeaderHeight;
      var vhUnitValue             = windowHeight / 100;

      // Replaces vh-based value with px: value * (editorWidth / 100)
      var updatedStyles = styles.replace(vhPatternGlobal, function(value) {
        var parsedValue  = parseInt(value);
        var updatedValue = parsedValue * vhUnitValue;

        return updatedValue + 'px';
      });

      return updatedStyles;
    },

    /**
     * Update vh-based adjustment when editor window is resized
     *
     * @since 4.1.0
     */
    onEditorWindowResize: function() {
      $('style#' + etBlockLayoutPreviewVhAdjustment.styleId)
        .html(etBlockLayoutPreviewVhAdjustment.getStyles());
    },
  };

  // Document is ready
  $(document).ready(function () {
    // Fix unwanted height calculation and unwanted scroll appearance on divi builder plugin due to
    // theme styling. Use classname + !important styling because it is more specific than inline
    // css added by JS
    $('html').each(function() {
      if ('hidden' === $(this).css('overflow') || 'scroll' === $(this).css('overflow-y')) {
        $(this).addClass('et-block-layout-force-overflow-auto');
      }
    });

    // Trigger custom event that will be captured by editor window which let it knows that layout
    // preview window has been loaded, rendered, and ready
    var layoutPreviewLoadEvent = new CustomEvent('ETBlockLayoutPreviewReady', {detail: {
      blockId: ETBlockLayoutPreview.blockId
    }});

    window.top.document.dispatchEvent(layoutPreviewLoadEvent);

    // Adjusting iframe styles; to be called inside etBlockDoIframeStylesAdjustment() only
    // since its usage requires etBlockAdjustIframeStyles() to be re-called one second after
    // the first etBlockAdjustIframeStyles() execution
    function etBlockAdjustIframeStyles() {
      var layoutHeight = $('html').height();
      var $blockIframe = window.top.jQuery('iframe[name="divi-layout-iframe-' + blockId + '"]');
      var $block       = $blockIframe.closest('.wp-block[data-type="divi/layout"]');

      // Reusable block doesn't use data-type attribute like normal block does. Thus if $block
      // length is empty, current layout might be inside reusable block; anticipate it accordingly
      if ($block.length < 1) {
        $block = $blockIframe.closest('.wp-block.is-reusable');
      }

      // Add necessary classname for all preview ancestor to reset their styles
      $('#et-boc').parents().addClass('et-pb-layout-preview-ancestor');

      // In DBP, loop wrapper DOM might have its own width / max-width style that causes preview
      // screen doesn't have fully width; loop over ancestor and check its width against its parent
      if ($('body').hasClass('et_divi_builder')) {
        $('#page-container .et-pb-layout-preview-ancestor').each(function() {
          if ($(this).width() !== $(this).parent().width()) {
            $(this).addClass('et-pb-layout-preview-width-correction');
          }
        });
      }

      // Fix Divi Layout block height

      if ($blockIframe.length) {
        // Fix iframe height
        $blockIframe.height(layoutHeight);

        // Remove unecessary space below iframe
        $blockIframe.parent().css({
          lineHeight: 1
        });

        // Clear iframe wrapper's height on final adjustment only so the block height doesn't
        // erratically shrunk then bounce back when being reloaded
        if (finalAdjustment) {
          $blockIframe.closest('.et-block').css({
            height: ''
          });
        }
      }

      // If layout block preview is rendered inside block inserter as reusable block's preview,
      // `#page-container` modification isn't needed. Instead, the iframe parent (`.et-block`)
      // needs to have fixed height value because iframe dimension will be scaled down using CSS3
      // so iframe height won't overflow the expected block height
      if ($blockIframe.closest('.editor-inserter__menu').length > 0) {
        var windowWidth        = window.top.innerWidth;
        var iframePreviewWidth = $blockIframe.parent().width();
        var blockLayoutHeight  = layoutHeight * (iframePreviewWidth / windowWidth);

        // Set fixed height on layout iframe parent so the scaled down iframe dimension
        // won't push the next block down
        $blockIframe.closest('.et-block').height(blockLayoutHeight);

        return;
      }

      // cssText for page container
      var cssText = 'margin: 0 auto !important;';

      // Get first section's box shadow possible offset due to box shadow usage
      var $topSection      = $('#page-container .et_pb_section:first');
      var topSectionOffset = $topSection.attr('data-box-shadow-offset');

      if (topSectionOffset) {
        cssText += ' padding-top: ' + topSectionOffset + ' !important;';
      }

      // Get last section's  box shadow possible offset due to box shadow usage
      var $bottomSection = $('#page-container .et_pb_section:last');
      var bottomSectionOffset = $bottomSection.attr('data-box-shadow-offset');

      if (bottomSectionOffset) {
        cssText += ' padding-bottom: ' + bottomSectionOffset + ' !important;';
      }

      // Block positioning related is changed on newest Gutenberg plugin; thus adjust accordingly
      var blockHorizontalPadding = '0px' === $block.css('paddingRight') ? 0 : 28;

      $('#page-container').css({
        cssText: cssText,
        width: window.ETBuilderBackend ? false : $block.outerWidth() - blockHorizontalPadding,
      });
    }

    // Perform etBlockAdjustIframeStyles() then re-execute it one second later for more accurate
    // iframe styling adjustment
    function etBlockDoIframeStylesAdjustment() {
      // Adjust iframe
      etBlockAdjustIframeStyles();

      // Re-run iframe adjustment after 1s just to be sure
      setTimeout(function () {
        // Set final adjustment to true
        finalAdjustment = true;

        etBlockAdjustIframeStyles();

        // Reset final adjustment
        finalAdjustment = false;
      }, 1000);
    }

    // Do adjust iframe styles
    etBlockDoIframeStylesAdjustment();

    // Adjust layout preview's iframe style when window is resized
    $(window).on('resize', et_pb_debounce(function () {
      etBlockDoIframeStylesAdjustment();
    }, 350));

    // Initialize vh adjustment
    etBlockLayoutPreviewVhAdjustment.init();

    // Debounce etBlockLayoutPreviewVhAdjustment.onEditorWindowResize.
    var onEditorWindowResize = window.et_pb_debounce(
      etBlockLayoutPreviewVhAdjustment.onEditorWindowResize,
      500
    );

    // Listen to editor window resize event
    window.top.addEventListener('resize', onEditorWindowResize);

    // If iframe window is unloaded (ie. due to block being removed), remove editor window listener
    window.addEventListener('unload', function () {
      window.top.removeEventListener('resize', onEditorWindowResize);
    });

    // Turn off all hrefs which point to another page
    $('body').on('click', 'a', function (event) {
      var href  = $(this).attr('href');
      var start = href.substr(0, 1);

      // If URL doesn't redirect to other page, let it be
      var beginsWithHash = '#' === start;

      if (beginsWithHash) {
        return;
      }

      // If URL is blog module's ajax-based pagination, let it works
      if ($(this).is('.et_pb_ajax_pagination_container .wp-pagenavi a,.et_pb_ajax_pagination_container .pagination a')) {
        return;
      }

      // Stop the link if it points to another URL or empty to prevent preview reloads itself
      event.preventDefault();

      // Avoid preview reloads when anchor tag with no `href` attribute is clicked
      var isEmpty = '' === start;

      if (isEmpty) {
        return false;
      }

      // Trigger custom event that will be captured by editor window which let it knows that
      // disabled link has been clicked
      window.top.document.dispatchEvent(new CustomEvent('ETBlockLayoutExternalLinkClick', {
        detail: {
          blockId: ETBlockLayoutPreview.blockId
        }
      }));

      return false;
    });

    // Disable all kind of form submission inside layout block preview
    $('body').on('submit', 'form', function(event) {
      event.preventDefault();

      // Trigger custom event that will be captured by editor window which let it knows that
      // disabled link has been clicked
      window.top.document.dispatchEvent(new CustomEvent('ETBlockLayoutUnwantedFormSubmission', {
      	detail: {
      		blockId: ETBlockLayoutPreview.blockId
      	}
      }));

      return false;
    });
  });
})(jQuery);
