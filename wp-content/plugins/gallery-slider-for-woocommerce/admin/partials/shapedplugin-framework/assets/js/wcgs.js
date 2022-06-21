/**
 * -----------------------------------------------------------
 *
 * Shapedplugin Framework
 *
 * -----------------------------------------------------------
 *
 */
; (function ($, window, document, undefined) {
  'use strict';

  //
  // Constants
  //
  var WCGS = WCGS || {};

  WCGS.funcs = {};

  WCGS.vars = {
    onloaded: false,
    $body: $('body'),
    $window: $(window),
    $document: $(document),
    is_rtl: $('body').hasClass('rtl'),
    code_themes: [],
  };

  //
  // Helper Functions
  //
  WCGS.helper = {

    //
    // Generate UID
    //
    uid: function (prefix) {
      return (prefix || '') + Math.random().toString(36).substr(2, 9);
    },

    // Quote regular expression characters
    //
    preg_quote: function (str) {
      return (str + '').replace(/(\[|\-|\])/g, "\\$1");
    },

    //
    // Reneme input names
    //
    name_nested_replace: function ($selector, field_id) {

      var checks = [];
      var regex = new RegExp('(' + WCGS.helper.preg_quote(field_id) + ')\\[(\\d+)\\]', 'g');

      $selector.find(':radio').each(function () {
        if (this.checked || this.orginal_checked) {
          this.orginal_checked = true;
        }
      });

      $selector.each(function (index) {
        $(this).find(':input').each(function () {
          this.name = this.name.replace(regex, field_id + '[' + index + ']');
          if (this.orginal_checked) {
            this.checked = true;
          }
        });
      });

    },

    //
    // Debounce
    //
    debounce: function (callback, threshold, immediate) {
      var timeout;
      return function () {
        var context = this, args = arguments;
        var later = function () {
          timeout = null;
          if (!immediate) {
            callback.apply(context, args);
          }
        };
        var callNow = (immediate && !timeout);
        clearTimeout(timeout);
        timeout = setTimeout(later, threshold);
        if (callNow) {
          callback.apply(context, args);
        }
      };
    },

    //
    // Get a cookie
    //
    get_cookie: function (name) {

      var e, b, cookie = document.cookie, p = name + '=';

      if (!cookie) {
        return;
      }

      b = cookie.indexOf('; ' + p);

      if (b === -1) {
        b = cookie.indexOf(p);

        if (b !== 0) {
          return null;
        }
      } else {
        b += 2;
      }

      e = cookie.indexOf(';', b);

      if (e === -1) {
        e = cookie.length;
      }

      return decodeURIComponent(cookie.substring(b + p.length, e));

    },

    //
    // Set a cookie
    //
    set_cookie: function (name, value, expires, path, domain, secure) {

      var d = new Date();

      if (typeof (expires) === 'object' && expires.toGMTString) {
        expires = expires.toGMTString();
      } else if (parseInt(expires, 10)) {
        d.setTime(d.getTime() + (parseInt(expires, 10) * 1000));
        expires = d.toGMTString();
      } else {
        expires = '';
      }

      document.cookie = name + '=' + encodeURIComponent(value) +
        (expires ? '; expires=' + expires : '') +
        (path ? '; path=' + path : '') +
        (domain ? '; domain=' + domain : '') +
        (secure ? '; secure' : '');

    },

    //
    // Remove a cookie
    //
    remove_cookie: function (name, path, domain, secure) {
      WCGS.helper.set_cookie(name, '', -1000, path, domain, secure);
    },

  };

  //
  // Custom clone for textarea and select clone() bug
  //
  $.fn.wcgs_clone = function () {

    var base = $.fn.clone.apply(this, arguments),
      clone = this.find('select').add(this.filter('select')),
      cloned = base.find('select').add(base.filter('select'));

    for (var i = 0; i < clone.length; ++i) {
      for (var j = 0; j < clone[i].options.length; ++j) {

        if (clone[i].options[j].selected === true) {
          cloned[i].options[j].selected = true;
        }

      }
    }

    this.find(':radio').each(function () {
      this.orginal_checked = this.checked;
    });

    return base;

  };

  //
  // Expand All Options
  //
  $.fn.wcgs_expand_all = function () {
    return this.each(function () {
      $(this).on('click', function (e) {

        e.preventDefault();
        $('.wcgs-wrapper').toggleClass('wcgs-show-all');
        $('.wcgs-section').wcgs_reload_script();
        $(this).find('.fa').toggleClass('fa-indent').toggleClass('fa-outdent');

      });
    });
  };

  //
  // Options Navigation
  //
  $.fn.wcgs_nav_options = function () {
    return this.each(function () {

      var $nav = $(this),
        $links = $nav.find('a'),
        $hidden = $nav.closest('.wcgs').find('.wcgs-section-id'),
        $last_section;

      $(window).on('hashchange', function () {

        var hash = window.location.hash.match(new RegExp('tab=([^&]*)'));
        var slug = hash ? hash[1] : $links.first().attr('href').replace('#tab=', '');
        var $link = $('#wcgs-tab-link-' + slug);



        if ($link.length > 0) {
          $link.closest('.wcgs-tab-depth-0').addClass('wcgs-tab-active').siblings().removeClass('wcgs-tab-active');
          $links.removeClass('wcgs-section-active');
          $link.addClass('wcgs-section-active');

          if ($last_section !== undefined) {
            $last_section.hide();
          }

          var $section = $('#wcgs-section-' + slug);
          $section.css({ display: 'block' });
          $section.wcgs_reload_script();

          $hidden.val(slug);

          $last_section = $section;

        }

      }).trigger('hashchange');

    });
  };

  //
  // Metabox Tabs
  //
  $.fn.wcgs_nav_metabox = function () {
    return this.each(function () {

      var $nav = $(this),
        $links = $nav.find('a'),
        unique_id = $nav.data('unique'),
        post_id = $('#post_ID').val() || 'global',
        $last_section,
        $last_link;

      $links.on('click', function (e) {

        e.preventDefault();

        var $link = $(this),
          section_id = $link.data('section');

        if ($last_link !== undefined) {
          $last_link.removeClass('wcgs-section-active');
        }

        if ($last_section !== undefined) {
          $last_section.hide();
        }

        $link.addClass('wcgs-section-active');

        var $section = $('#wcgs-section-' + section_id);
        $section.css({ display: 'block' });
        $section.wcgs_reload_script();

        WCGS.helper.set_cookie('wcgs-last-metabox-tab-' + post_id + '-' + unique_id, section_id);

        $last_section = $section;
        $last_link = $link;

      });

      var get_cookie = WCGS.helper.get_cookie('wcgs-last-metabox-tab-' + post_id + '-' + unique_id);

      if (get_cookie) {
        $nav.find('a[data-section="' + get_cookie + '"]').trigger('click');
      } else {
        $links.first('a').trigger('click');
      }

    });
  };

  //
  // Metabox Page Templates Listener
  //
  $.fn.wcgs_page_templates = function () {
    if (this.length) {

      $(document).on('change', '.editor-page-attributes__template select, #page_template', function () {

        var maybe_value = $(this).val() || 'default';

        $('.wcgs-page-templates').removeClass('wcgs-show').addClass('wcgs-hide');
        $('.wcgs-page-' + maybe_value.toLowerCase().replace(/[^a-zA-Z0-9]+/g, '-')).removeClass('wcgs-hide').addClass('wcgs-show');

      });

    }
  };

  //
  // Metabox Post Formats Listener
  //
  $.fn.wcgs_post_formats = function () {
    if (this.length) {

      $(document).on('change', '.editor-post-format select, #formatdiv input[name="post_format"]', function () {

        var maybe_value = $(this).val() || 'default';

        // Fallback for classic editor version
        maybe_value = (maybe_value === '0') ? 'default' : maybe_value;

        $('.wcgs-post-formats').removeClass('wcgs-show').addClass('wcgs-hide');
        $('.wcgs-post-format-' + maybe_value).removeClass('wcgs-hide').addClass('wcgs-show');

      });

    }
  };

  //
  // Search
  //
  $.fn.wcgs_search = function () {
    return this.each(function () {

      var $this = $(this),
        $input = $this.find('input');

      $input.on('change keyup', function () {

        var value = $(this).val(),
          $wrapper = $('.wcgs-wrapper'),
          $section = $wrapper.find('.wcgs-section'),
          $fields = $section.find('> .wcgs-field:not(.hidden)'),
          $titles = $fields.find('> .wcgs-title, .wcgs-search-tags');

        if (value.length > 3) {

          $fields.addClass('wcgs-hidden');
          $wrapper.addClass('wcgs-search-all');

          $titles.each(function () {

            var $title = $(this);

            if ($title.text().match(new RegExp('.*?' + value + '.*?', 'i'))) {

              var $field = $title.closest('.wcgs-field');

              $field.removeClass('wcgs-hidden');
              $field.parent().wcgs_reload_script();

            }

          });

        } else {

          $fields.removeClass('wcgs-hidden');
          $wrapper.removeClass('wcgs-search-all');

        }

      });

    });
  };

  //
  // Sticky Header
  //
  $.fn.wcgs_sticky = function () {
    return this.each(function () {

      var $this = $(this),
        $window = $(window),
        $inner = $this.find('.wcgs-header-inner'),
        padding = parseInt($inner.css('padding-left')) + parseInt($inner.css('padding-right')),
        offset = 32,
        scrollTop = 0,
        lastTop = 0,
        ticking = false,
        stickyUpdate = function () {

          var offsetTop = $this.offset().top,
            stickyTop = Math.max(offset, offsetTop - scrollTop),
            winWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);

          if (stickyTop <= offset && winWidth > 782) {
            $inner.css({ width: $this.outerWidth() - padding });
            $this.css({ height: $this.outerHeight() }).addClass('wcgs-sticky');
          } else {
            $inner.removeAttr('style');
            $this.removeAttr('style').removeClass('wcgs-sticky');
          }

        },
        requestTick = function () {

          if (!ticking) {
            requestAnimationFrame(function () {
              stickyUpdate();
              ticking = false;
            });
          }

          ticking = true;

        },
        onSticky = function () {

          scrollTop = $window.scrollTop();
          requestTick();

        };

      $window.on('scroll resize', onSticky);

      onSticky();

    });
  };

  //
  // Dependency System
  //
  $.fn.wcgs_dependency = function () {
    return this.each(function () {

      var $this = $(this),
        ruleset = $.wcgs_deps.createRuleset(),
        depends = [],
        is_global = false;

      $this.children('[data-controller]').each(function () {

        var $field = $(this),
          controllers = $field.data('controller').split('|'),
          conditions = $field.data('condition').split('|'),
          values = $field.data('value').toString().split('|'),
          rules = ruleset;

        if ($field.data('depend-global')) {
          is_global = true;
        }

        $.each(controllers, function (index, depend_id) {

          var value = values[index] || '',
            condition = conditions[index] || conditions[0];

          rules = rules.createRule('[data-depend-id="' + depend_id + '"]', condition, value);

          rules.include($field);

          depends.push(depend_id);

        });

      });

      if (depends.length) {

        if (is_global) {
          $.wcgs_deps.enable(WCGS.vars.$body, ruleset, depends);
        } else {
          $.wcgs_deps.enable($this, ruleset, depends);
        }

      }

    });
  };

  //
  // Field: accordion
  //
  $.fn.wcgs_field_accordion = function () {
    return this.each(function () {

      var $titles = $(this).find('.wcgs-accordion-title');

      $titles.on('click', function () {

        var $title = $(this),
          $icon = $title.find('.wcgs-accordion-icon'),
          $content = $title.next();

        if ($icon.hasClass('fa-angle-right')) {
          $icon.removeClass('fa-angle-right').addClass('fa-angle-down');
        } else {
          $icon.removeClass('fa-angle-down').addClass('fa-angle-right');
        }

        if (!$content.data('opened')) {

          $content.wcgs_reload_script();
          $content.data('opened', true);

        }

        $content.toggleClass('wcgs-accordion-open');

      });

    });
  };

  //
  // Field: background
  //
  $.fn.wcgs_field_background = function () {
    return this.each(function () {
      $(this).find('.wcgs--media').wcgs_reload_script();
    });
  };

  //
  // Field: code_editor
  //
  $.fn.wcgs_field_code_editor = function () {
    return this.each(function () {

      if (typeof CodeMirror !== 'function') { return; }

      var $this = $(this),
        $textarea = $this.find('textarea'),
        $inited = $this.find('.CodeMirror'),
        data_editor = $textarea.data('editor');

      if ($inited.length) {
        $inited.remove();
      }

      var interval = setInterval(function () {
        if ($this.is(':visible')) {

          var code_editor = CodeMirror.fromTextArea($textarea[0], data_editor);

          // load code-mirror theme css.
          if (data_editor.theme !== 'default' && WCGS.vars.code_themes.indexOf(data_editor.theme) === -1) {

            var $cssLink = $('<link>');

            $('#wcgs-codemirror-css').after($cssLink);

            $cssLink.attr({
              rel: 'stylesheet',
              id: 'wcgs-codemirror-' + data_editor.theme + '-css',
              href: data_editor.cdnURL + '/theme/' + data_editor.theme + '.min.css',
              type: 'text/css',
              media: 'all'
            });

            WCGS.vars.code_themes.push(data_editor.theme);

          }

          CodeMirror.modeURL = data_editor.cdnURL + '/mode/%N/%N.min.js';
          CodeMirror.autoLoadMode(code_editor, data_editor.mode);

          code_editor.on('change', function (editor, event) {
            $textarea.val(code_editor.getValue()).trigger('change');
          });

          clearInterval(interval);

        }
      });

    });
  };

  //
  // Field: date
  //
  $.fn.wcgs_field_date = function () {
    return this.each(function () {

      var $this = $(this),
        $inputs = $this.find('input'),
        settings = $this.find('.wcgs-date-settings').data('settings'),
        wrapper = '<div class="wcgs-datepicker-wrapper"></div>',
        $datepicker;

      var defaults = {
        showAnim: '',
        beforeShow: function (input, inst) {
          $(inst.dpDiv).addClass('wcgs-datepicker-wrapper');
        },
        onClose: function (input, inst) {
          $(inst.dpDiv).removeClass('wcgs-datepicker-wrapper');
        },
      };

      settings = $.extend({}, settings, defaults);

      if ($inputs.length === 2) {

        settings = $.extend({}, settings, {
          onSelect: function (selectedDate) {

            var $this = $(this),
              $from = $inputs.first(),
              option = ($inputs.first().attr('id') === $(this).attr('id')) ? 'minDate' : 'maxDate',
              date = $.datepicker.parseDate(settings.dateFormat, selectedDate);

            $inputs.not(this).datepicker('option', option, date);

          }
        });

      }

      $inputs.each(function () {

        var $input = $(this);

        if ($input.hasClass('hasDatepicker')) {
          $input.removeAttr('id').removeClass('hasDatepicker');
        }

        $input.datepicker(settings);

      });

    });
  };

  //
  // Field: fieldset
  //
  $.fn.wcgs_field_fieldset = function () {
    return this.each(function () {
      $(this).find('.wcgs-fieldset-content').wcgs_reload_script();
    });
  };

  //
  // Field: gallery
  //
  $.fn.wcgs_field_gallery = function () {
    return this.each(function () {

      var $this = $(this),
        $edit = $this.find('.wcgs-edit-gallery'),
        $clear = $this.find('.wcgs-clear-gallery'),
        $list = $this.find('ul'),
        $input = $this.find('input'),
        $img = $this.find('img'),
        wp_media_frame;

      $this.on('click', '.wcgs-button, .wcgs-edit-gallery', function (e) {

        var $el = $(this),
          ids = $input.val(),
          what = ($el.hasClass('wcgs-edit-gallery')) ? 'edit' : 'add',
          state = (what === 'add' && !ids.length) ? 'gallery' : 'gallery-edit';

        e.preventDefault();

        if (typeof window.wp === 'undefined' || !window.wp.media || !window.wp.media.gallery) { return; }

        // Open media with state
        if (state === 'gallery') {

          wp_media_frame = window.wp.media({
            library: {
              type: 'image'
            },
            frame: 'post',
            state: 'gallery',
            multiple: true
          });

          wp_media_frame.open();

        } else {

          wp_media_frame = window.wp.media.gallery.edit('[gallery ids="' + ids + '"]');

          if (what === 'add') {
            wp_media_frame.setState('gallery-library');
          }

        }

        // Media Update
        wp_media_frame.on('update', function (selection) {

          $list.empty();

          var selectedIds = selection.models.map(function (attachment) {

            var item = attachment.toJSON();
            var thumb = (typeof item.sizes.thumbnail !== 'undefined') ? item.sizes.thumbnail.url : item.url;

            $list.append('<li><img src="' + thumb + '"></li>');

            return item.id;

          });

          $input.val(selectedIds.join(',')).trigger('change');
          $clear.removeClass('hidden');
          $edit.removeClass('hidden');

        });

      });

      $clear.on('click', function (e) {
        e.preventDefault();
        $list.empty();
        $input.val('').trigger('change');
        $clear.addClass('hidden');
        $edit.addClass('hidden');
      });

    });

  };

  //
  // Field: group
  //
  $.fn.wcgs_field_group = function () {
    return this.each(function () {

      var $this = $(this),
        $fieldset = $this.children('.wcgs-fieldset'),
        $group = $fieldset.length ? $fieldset : $this,
        $wrapper = $group.children('.wcgs-cloneable-wrapper'),
        $hidden = $group.children('.wcgs-cloneable-hidden'),
        $max = $group.children('.wcgs-cloneable-max'),
        $min = $group.children('.wcgs-cloneable-min'),
        field_id = $wrapper.data('field-id'),
        unique_id = $wrapper.data('unique-id'),
        is_number = Boolean(Number($wrapper.data('title-number'))),
        max = parseInt($wrapper.data('max')),
        min = parseInt($wrapper.data('min'));

      // clear accordion arrows if multi-instance
      if ($wrapper.hasClass('ui-accordion')) {
        $wrapper.find('.ui-accordion-header-icon').remove();
      }

      var update_title_numbers = function ($selector) {
        $selector.find('.wcgs-cloneable-title-number').each(function (index) {
          $(this).html(($(this).closest('.wcgs-cloneable-item').index() + 1) + '.');
        });
      };

      $wrapper.accordion({
        header: '> .wcgs-cloneable-item > .wcgs-cloneable-title',
        collapsible: true,
        active: false,
        animate: false,
        heightStyle: 'content',
        icons: {
          'header': 'wcgs-cloneable-header-icon fa fa-angle-right',
          'activeHeader': 'wcgs-cloneable-header-icon fa fa-angle-down'
        },
        activate: function (event, ui) {

          var $panel = ui.newPanel;
          var $header = ui.newHeader;

          if ($panel.length && !$panel.data('opened')) {

            var $fields = $panel.children();
            var $first = $fields.first().find(':input').first();
            var $title = $header.find('.wcgs-cloneable-value');

            $first.on('keyup', function (event) {
              $title.text($first.val());
            });

            $panel.wcgs_reload_script();
            $panel.data('opened', true);
            $panel.data('retry', false);

          } else if ($panel.data('retry')) {

            $panel.wcgs_reload_script_retry();
            $panel.data('retry', false);

          }

        }
      });

      $wrapper.sortable({
        axis: 'y',
        handle: '.wcgs-cloneable-title,.wcgs-cloneable-sort',
        helper: 'original',
        cursor: 'move',
        placeholder: 'widget-placeholder',
        start: function (event, ui) {

          $wrapper.accordion({ active: false });
          $wrapper.sortable('refreshPositions');
          ui.item.children('.wcgs-cloneable-content').data('retry', true);

        },
        update: function (event, ui) {

          WCGS.helper.name_nested_replace($wrapper.children('.wcgs-cloneable-item'), field_id);
          $wrapper.wcgs_customizer_refresh();

          if (is_number) {
            update_title_numbers($wrapper);
          }

        },
      });

      $group.children('.wcgs-cloneable-add').on('click', function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-cloneable-item').length;

        $min.hide();

        if (max && (count + 1) > max) {
          $max.show();
          return;
        }

        var new_field_id = unique_id + field_id + '[' + count + ']';

        var $cloned_item = $hidden.wcgs_clone(true);

        $cloned_item.removeClass('wcgs-cloneable-hidden');

        $cloned_item.find(':input').each(function () {
          this.name = new_field_id + this.name.replace((this.name.startsWith('_nonce') ? '_nonce' : unique_id), '');
        });

        $cloned_item.find('.wcgs-data-wrapper').each(function () {
          $(this).attr('data-unique-id', new_field_id);
        });

        $wrapper.append($cloned_item);
        $wrapper.accordion('refresh');
        $wrapper.accordion({ active: count });
        $wrapper.wcgs_customizer_refresh();
        $wrapper.wcgs_customizer_listen({ closest: true });

        if (is_number) {
          update_title_numbers($wrapper);
        }

      });

      var event_clone = function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-cloneable-item').length;

        $min.hide();

        if (max && (count + 1) > max) {
          $max.show();
          return;
        }

        var $this = $(this),
          $parent = $this.parent().parent(),
          $cloned_helper = $parent.children('.wcgs-cloneable-helper').wcgs_clone(true),
          $cloned_title = $parent.children('.wcgs-cloneable-title').wcgs_clone(),
          $cloned_content = $parent.children('.wcgs-cloneable-content').wcgs_clone(),
          cloned_regex = new RegExp('(' + WCGS.helper.preg_quote(field_id) + ')\\[(\\d+)\\]', 'g');

        $cloned_content.find('.wcgs-data-wrapper').each(function () {
          var $this = $(this);
          $this.attr('data-unique-id', $this.attr('data-unique-id').replace(cloned_regex, field_id + '[' + ($parent.index() + 1) + ']'));
        });

        var $cloned = $('<div class="wcgs-cloneable-item" />');

        $cloned.append($cloned_helper);
        $cloned.append($cloned_title);
        $cloned.append($cloned_content);

        $wrapper.children().eq($parent.index()).after($cloned);

        WCGS.helper.name_nested_replace($wrapper.children('.wcgs-cloneable-item'), field_id);

        $wrapper.accordion('refresh');
        $wrapper.wcgs_customizer_refresh();
        $wrapper.wcgs_customizer_listen({ closest: true });

        if (is_number) {
          update_title_numbers($wrapper);
        }

      };

      $wrapper.children('.wcgs-cloneable-item').children('.wcgs-cloneable-helper').on('click', '.wcgs-cloneable-clone', event_clone);
      $group.children('.wcgs-cloneable-hidden').children('.wcgs-cloneable-helper').on('click', '.wcgs-cloneable-clone', event_clone);

      var event_remove = function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-cloneable-item').length;

        $max.hide();
        $min.hide();

        if (min && (count - 1) < min) {
          $min.show();
          return;
        }

        $(this).closest('.wcgs-cloneable-item').remove();

        WCGS.helper.name_nested_replace($wrapper.children('.wcgs-cloneable-item'), field_id);

        $wrapper.wcgs_customizer_refresh();

        if (is_number) {
          update_title_numbers($wrapper);
        }

      };

      $wrapper.children('.wcgs-cloneable-item').children('.wcgs-cloneable-helper').on('click', '.wcgs-cloneable-remove', event_remove);
      $group.children('.wcgs-cloneable-hidden').children('.wcgs-cloneable-helper').on('click', '.wcgs-cloneable-remove', event_remove);

    });
  };

  //
  // Field: icon
  //
  $.fn.wcgs_field_icon = function () {
    return this.each(function () {

      var $this = $(this);

      $this.on('click', '.wcgs-icon-add', function (e) {

        e.preventDefault();

        var $button = $(this);
        var $modal = $('#wcgs-modal-icon');

        $modal.show();

        WCGS.vars.$icon_target = $this;

        if (!WCGS.vars.icon_modal_loaded) {

          $modal.find('.wcgs-modal-loading').show();

          window.wp.ajax.post('wcgs-get-icons', { nonce: $button.data('nonce') }).done(function (response) {

            $modal.find('.wcgs-modal-loading').hide();

            WCGS.vars.icon_modal_loaded = true;

            var $load = $modal.find('.wcgs-modal-load').html(response.content);

            $load.on('click', 'a', function (e) {

              e.preventDefault();

              var icon = $(this).data('wcgs-icon');

              WCGS.vars.$icon_target.find('i').removeAttr('class').addClass(icon);
              WCGS.vars.$icon_target.find('input').val(icon).trigger('change');
              WCGS.vars.$icon_target.find('.wcgs-icon-preview').removeClass('hidden');
              WCGS.vars.$icon_target.find('.wcgs-icon-remove').removeClass('hidden');

              $modal.hide();

            });

            $modal.on('change keyup', '.wcgs-icon-search', function () {

              var value = $(this).val(),
                $icons = $load.find('a');

              $icons.each(function () {

                var $elem = $(this);

                if ($elem.data('wcgs-icon').search(new RegExp(value, 'i')) < 0) {
                  $elem.hide();
                } else {
                  $elem.show();
                }

              });

            });

            $modal.on('click', '.wcgs-modal-close, .wcgs-modal-overlay', function () {

              $modal.hide();

            });

          });

        }

      });

      $this.on('click', '.wcgs-icon-remove', function (e) {

        e.preventDefault();

        $this.find('.wcgs-icon-preview').addClass('hidden');
        $this.find('input').val('').trigger('change');
        $(this).addClass('hidden');

      });

    });
  };

  //
  // Field: media
  //
  $.fn.wcgs_field_media = function () {
    return this.each(function () {

      var $this = $(this),
        $upload_button = $this.find('.wcgs--button'),
        $remove_button = $this.find('.wcgs--remove'),
        $library = $upload_button.data('library') && $upload_button.data('library').split(',') || '',
        wp_media_frame;

      $upload_button.on('click', function (e) {

        e.preventDefault();

        if (typeof window.wp === 'undefined' || !window.wp.media || !window.wp.media.gallery) {
          return;
        }

        if (wp_media_frame) {
          wp_media_frame.open();
          return;
        }

        wp_media_frame = window.wp.media({
          library: {
            type: $library
          }
        });

        wp_media_frame.on('select', function () {

          var thumbnail;
          var attributes = wp_media_frame.state().get('selection').first().attributes;
          var preview_size = $upload_button.data('preview-size') || 'thumbnail';

          if ($library.length && $library.indexOf(attributes.subtype) === -1 && $library.indexOf(attributes.type) === -1) {
            return;
          }

          $this.find('.wcgs--url').val(attributes.url);
          $this.find('.wcgs--id').val(attributes.id);
          $this.find('.wcgs--width').val(attributes.width);
          $this.find('.wcgs--height').val(attributes.height);
          $this.find('.wcgs--alt').val(attributes.alt);
          $this.find('.wcgs--title').val(attributes.title);
          $this.find('.wcgs--description').val(attributes.description);

          if (typeof attributes.sizes !== 'undefined' && typeof attributes.sizes.thumbnail !== 'undefined' && preview_size === 'thumbnail') {
            thumbnail = attributes.sizes.thumbnail.url;
          } else if (typeof attributes.sizes !== 'undefined' && typeof attributes.sizes.full !== 'undefined') {
            thumbnail = attributes.sizes.full.url;
          } else {
            thumbnail = attributes.icon;
          }

          $remove_button.removeClass('hidden');
          $this.find('.wcgs--preview').removeClass('hidden');
          $this.find('.wcgs--src').attr('src', thumbnail);
          $this.find('.wcgs--thumbnail').val(thumbnail).trigger('change');

        });

        wp_media_frame.open();

      });

      $remove_button.on('click', function (e) {
        e.preventDefault();
        $remove_button.addClass('hidden');
        $this.find('.wcgs--preview').addClass('hidden');
        $this.find('input').val('');
        $this.find('.wcgs--thumbnail').trigger('change');
      });

    });

  };

  //
  // Field: repeater
  //
  $.fn.wcgs_field_repeater = function () {
    return this.each(function () {

      var $this = $(this),
        $fieldset = $this.children('.wcgs-fieldset'),
        $repeater = $fieldset.length ? $fieldset : $this,
        $wrapper = $repeater.children('.wcgs-repeater-wrapper'),
        $hidden = $repeater.children('.wcgs-repeater-hidden'),
        $max = $repeater.children('.wcgs-repeater-max'),
        $min = $repeater.children('.wcgs-repeater-min'),
        field_id = $wrapper.data('field-id'),
        unique_id = $wrapper.data('unique-id'),
        max = parseInt($wrapper.data('max')),
        min = parseInt($wrapper.data('min'));


      $wrapper.children('.wcgs-repeater-item').children('.wcgs-repeater-content').wcgs_reload_script();

      $wrapper.sortable({
        axis: 'y',
        handle: '.wcgs-repeater-sort',
        helper: 'original',
        cursor: 'move',
        placeholder: 'widget-placeholder',
        update: function (event, ui) {

          WCGS.helper.name_nested_replace($wrapper.children('.wcgs-repeater-item'), field_id);
          $wrapper.wcgs_customizer_refresh();
          ui.item.wcgs_reload_script_retry();

        }
      });

      $repeater.children('.wcgs-repeater-add').on('click', function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-repeater-item').length;

        $min.hide();

        if (max && (count + 1) > max) {
          $max.show();
          return;
        }

        var new_field_id = unique_id + field_id + '[' + count + ']';

        var $cloned_item = $hidden.wcgs_clone(true);

        $cloned_item.removeClass('wcgs-repeater-hidden');

        $cloned_item.find(':input').each(function () {
          this.name = new_field_id + this.name.replace((this.name.startsWith('_nonce') ? '_nonce' : unique_id), '');
        });

        $cloned_item.find('.wcgs-data-wrapper').each(function () {
          $(this).attr('data-unique-id', new_field_id);
        });

        $wrapper.append($cloned_item);
        $cloned_item.children('.wcgs-repeater-content').wcgs_reload_script();
        $wrapper.wcgs_customizer_refresh();
        $wrapper.wcgs_customizer_listen({ closest: true });

      });

      var event_clone = function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-repeater-item').length;

        $min.hide();

        if (max && (count + 1) > max) {
          $max.show();
          return;
        }

        var $this = $(this),
          $parent = $this.parent().parent().parent(),
          $cloned_content = $parent.children('.wcgs-repeater-content').wcgs_clone(),
          $cloned_helper = $parent.children('.wcgs-repeater-helper').wcgs_clone(true),
          cloned_regex = new RegExp('(' + WCGS.helper.preg_quote(field_id) + ')\\[(\\d+)\\]', 'g');

        $cloned_content.find('.wcgs-data-wrapper').each(function () {
          var $this = $(this);
          $this.attr('data-unique-id', $this.attr('data-unique-id').replace(cloned_regex, field_id + '[' + ($parent.index() + 1) + ']'));
        });

        var $cloned = $('<div class="wcgs-repeater-item" />');

        $cloned.append($cloned_content);
        $cloned.append($cloned_helper);

        $wrapper.children().eq($parent.index()).after($cloned);

        $cloned.children('.wcgs-repeater-content').wcgs_reload_script();

        WCGS.helper.name_nested_replace($wrapper.children('.wcgs-repeater-item'), field_id);

        $wrapper.wcgs_customizer_refresh();
        $wrapper.wcgs_customizer_listen({ closest: true });

      };

      $wrapper.children('.wcgs-repeater-item').children('.wcgs-repeater-helper').on('click', '.wcgs-repeater-clone', event_clone);
      $repeater.children('.wcgs-repeater-hidden').children('.wcgs-repeater-helper').on('click', '.wcgs-repeater-clone', event_clone);

      var event_remove = function (e) {

        e.preventDefault();

        var count = $wrapper.children('.wcgs-repeater-item').length;

        $max.hide();
        $min.hide();

        if (min && (count - 1) < min) {
          $min.show();
          return;
        }

        $(this).closest('.wcgs-repeater-item').remove();

        WCGS.helper.name_nested_replace($wrapper.children('.wcgs-repeater-item'), field_id);

        $wrapper.wcgs_customizer_refresh();

      };

      $wrapper.children('.wcgs-repeater-item').children('.wcgs-repeater-helper').on('click', '.wcgs-repeater-remove', event_remove);
      $repeater.children('.wcgs-repeater-hidden').children('.wcgs-repeater-helper').on('click', '.wcgs-repeater-remove', event_remove);

    });
  };

  //
  // Field: slider
  //
  $.fn.wcgs_field_slider = function () {
    return this.each(function () {

      var $this = $(this),
        $input = $this.find('input'),
        $slider = $this.find('.wcgs-slider-ui'),
        data = $input.data(),
        value = $input.val() || 0;

      if ($slider.hasClass('ui-slider')) {
        $slider.empty();
      }

      $slider.slider({
        range: 'min',
        value: value,
        min: data.min,
        max: data.max,
        step: data.step,
        slide: function (e, o) {
          $input.val(o.value).trigger('change');
        }
      });

      $input.keyup(function () {
        $slider.slider('value', $input.val());
      });

    });
  };

  //
  // Field: sortable
  //
  $.fn.wcgs_field_sortable = function () {
    return this.each(function () {

      var $sortable = $(this).find('.wcgs--sortable');

      $sortable.sortable({
        axis: 'y',
        helper: 'original',
        cursor: 'move',
        placeholder: 'widget-placeholder',
        update: function (event, ui) {
          $sortable.wcgs_customizer_refresh();
        }
      });

      $sortable.find('.wcgs--sortable-content').wcgs_reload_script();

    });
  };

  //
  // Field: sorter
  //
  $.fn.wcgs_field_sorter = function () {
    return this.each(function () {

      var $this = $(this),
        $enabled = $this.find('.wcgs-enabled'),
        $has_disabled = $this.find('.wcgs-disabled'),
        $disabled = ($has_disabled.length) ? $has_disabled : false;

      $enabled.sortable({
        connectWith: $disabled,
        placeholder: 'ui-sortable-placeholder',
        update: function (event, ui) {

          var $el = ui.item.find('input');

          if (ui.item.parent().hasClass('wcgs-enabled')) {
            $el.attr('name', $el.attr('name').replace('disabled', 'enabled'));
          } else {
            $el.attr('name', $el.attr('name').replace('enabled', 'disabled'));
          }

          $this.wcgs_customizer_refresh();

        }
      });

      if ($disabled) {

        $disabled.sortable({
          connectWith: $enabled,
          placeholder: 'ui-sortable-placeholder',
          update: function (event, ui) {
            $this.wcgs_customizer_refresh();
          }
        });

      }

    });
  };

  //
  // Field: spinner
  //
  $.fn.wcgs_field_spinner = function () {
    return this.each(function () {

      var $this = $(this),
        $input = $this.find('input'),
        $inited = $this.find('.ui-spinner-button');

      if ($inited.length) {
        $inited.remove();
      }

      $input.spinner({
        max: $input.data('max') || 100,
        min: $input.data('min') || 0,
        step: $input.data('step') || 1,
        spin: function (event, ui) {
          $input.val(ui.value).trigger('change');
        }
      });


    });
  };

  //
  // Field: switcher
  //
  $.fn.wcgs_field_switcher = function () {
    return this.each(function () {

      var $switcher = $(this).find('.wcgs--switcher');

      $switcher.on('click', function () {

        var value = 0;
        var $input = $switcher.find('input');

        if ($switcher.hasClass('wcgs--active')) {
          $switcher.removeClass('wcgs--active');
        } else {
          value = 1;
          $switcher.addClass('wcgs--active');
        }

        $input.val(value).trigger('change');

      });

    });
  };

  //
  // Field: tabbed
  //
  $.fn.wcgs_field_tabbed = function () {
    return this.each(function () {

      var $this = $(this),
        $links = $this.find('.wcgs-tabbed-nav a'),
        $sections = $this.find('.wcgs-tabbed-section');

      $sections.eq(0).wcgs_reload_script();

      $links.on('click', function (e) {

        e.preventDefault();

        var $link = $(this),
          index = $link.index(),
          $section = $sections.eq(index);

        $link.addClass('wcgs-tabbed-active').siblings().removeClass('wcgs-tabbed-active');
        $section.wcgs_reload_script();
        $section.removeClass('hidden').siblings().addClass('hidden');

      });

    });
  };

  //
  // Field: upload
  //
  $.fn.wcgs_field_upload = function () {
    return this.each(function () {

      var $this = $(this),
        $input = $this.find('input'),
        $upload_button = $this.find('.wcgs--button'),
        $remove_button = $this.find('.wcgs--remove'),
        $library = $upload_button.data('library') && $upload_button.data('library').split(',') || '',
        wp_media_frame;

      $input.on('change', function (e) {
        if ($input.val()) {
          $remove_button.removeClass('hidden');
        } else {
          $remove_button.addClass('hidden');
        }
      });

      $upload_button.on('click', function (e) {

        e.preventDefault();

        if (typeof window.wp === 'undefined' || !window.wp.media || !window.wp.media.gallery) {
          return;
        }

        if (wp_media_frame) {
          wp_media_frame.open();
          return;
        }

        wp_media_frame = window.wp.media({
          library: {
            type: $library
          },
        });

        wp_media_frame.on('select', function () {

          var attributes = wp_media_frame.state().get('selection').first().attributes;

          if ($library.length && $library.indexOf(attributes.subtype) === -1 && $library.indexOf(attributes.type) === -1) {
            return;
          }

          $input.val(attributes.url).trigger('change');

        });

        wp_media_frame.open();

      });

      $remove_button.on('click', function (e) {
        e.preventDefault();
        $input.val('').trigger('change');
      });

    });

  };

  //
  // Confirm
  //
  $.fn.wcgs_confirm = function () {
    return this.each(function () {
      $(this).on('click', function (e) {

        var confirm_text = $(this).data('confirm') || window.wcgs_vars.i18n.confirm;
        var confirm_answer = confirm(confirm_text);
        WCGS.vars.is_confirm = true;

        if (!confirm_answer) {
          e.preventDefault();
          WCGS.vars.is_confirm = false;
          return false;
        }

      });
    });
  };

  $.fn.serializeObject = function () {

    var obj = {};

    $.each(this.serializeArray(), function (i, o) {
      var n = o.name,
        v = o.value;

      obj[n] = obj[n] === undefined ? v
        : $.isArray(obj[n]) ? obj[n].concat(v)
          : [obj[n], v];
    });

    return obj;

  };

  //
  // Options Save
  //
  $.fn.wcgs_save = function () {
    return this.each(function () {

      var $this = $(this),
        $buttons = $('.wcgs-save'),
        $panel = $('.wcgs-options'),
        flooding = false,
        timeout;

      $this.on('click', function (e) {

        if (!flooding) {

          var $text = $this.data('save'),
            $value = $this.val();

          $buttons.attr('value', $text);

          if ($this.hasClass('wcgs-save-ajax')) {

            e.preventDefault();

            $panel.addClass('wcgs-saving');
            $buttons.prop('disabled', true);

            window.wp.ajax.post('wcgs_' + $panel.data('unique') + '_ajax_save', {
              data: $('#wcgs-form').serializeJSONWCGS()
            })
              .done(function (response) {

                clearTimeout(timeout);

                var $result_success = $('.wcgs-form-success');

                $result_success.empty().append(response.notice).slideDown('fast', function () {
                  timeout = setTimeout(function () {
                    $result_success.slideUp('fast');
                  }, 2000);
                });

                // clear errors
                $('.wcgs-error').remove();

                var $append_errors = $('.wcgs-form-error');

                $append_errors.empty().hide();

                if (Object.keys(response.errors).length) {

                  var error_icon = '<i class="wcgs-label-error wcgs-error">!</i>';

                  $.each(response.errors, function (key, error_message) {

                    var $field = $('[data-depend-id="' + key + '"]'),
                      $link = $('#wcgs-tab-link-' + ($field.closest('.wcgs-section').index() + 1)),
                      $tab = $link.closest('.wcgs-tab-depth-0');

                    $field.closest('.wcgs-fieldset').append('<p class="wcgs-text-error wcgs-error">' + error_message + '</p>');

                    if (!$link.find('.wcgs-error').length) {
                      $link.append(error_icon);
                    }

                    if (!$tab.find('.wcgs-arrow .wcgs-error').length) {
                      $tab.find('.wcgs-arrow').append(error_icon);
                    }

                    console.log(error_message);

                    $append_errors.append('<div>' + error_icon + ' ' + error_message + '</div>');

                  });

                  $append_errors.show();

                }

                $panel.removeClass('wcgs-saving');
                $buttons.prop('disabled', false).attr('value', $value);
                flooding = false;

              })
              .fail(function (response) {
                alert(response.error);
              });

          }

        }

        flooding = true;

      });

    });
  };

  //
  // Taxonomy Framework
  //
  $.fn.wcgs_taxonomy = function () {
    return this.each(function () {

      var $this = $(this),
        $form = $this.parents('form');

      if ($form.attr('id') === 'addtag') {

        var $submit = $form.find('#submit'),
          $cloned = $this.find('.wcgs-field').wcgs_clone();

        $submit.on('click', function () {

          if (!$form.find('.form-required').hasClass('form-invalid')) {

            $this.data('inited', false);

            $this.empty();

            $this.html($cloned);

            $cloned = $cloned.wcgs_clone();

            $this.wcgs_reload_script();

          }

        });

      }

    });
  };

  //
  // Shortcode Framework
  //
  $.fn.wcgs_shortcode = function () {

    var base = this;

    base.shortcode_parse = function (serialize, key) {

      var shortcode = '';

      $.each(serialize, function (shortcode_key, shortcode_values) {

        key = (key) ? key : shortcode_key;

        shortcode += '[' + key;

        $.each(shortcode_values, function (shortcode_tag, shortcode_value) {

          if (shortcode_tag === 'content') {

            shortcode += ']';
            shortcode += shortcode_value;
            shortcode += '[/' + key + '';

          } else {

            shortcode += base.shortcode_tags(shortcode_tag, shortcode_value);

          }

        });

        shortcode += ']';

      });

      return shortcode;

    };

    base.shortcode_tags = function (shortcode_tag, shortcode_value) {

      var shortcode = '';

      if (shortcode_value !== '') {

        if (typeof shortcode_value === 'object' && !$.isArray(shortcode_value)) {

          $.each(shortcode_value, function (sub_shortcode_tag, sub_shortcode_value) {

            // sanitize spesific key/value
            switch (sub_shortcode_tag) {

              case 'background-image':
                sub_shortcode_value = (sub_shortcode_value.url) ? sub_shortcode_value.url : '';
                break;

            }

            if (sub_shortcode_value !== '') {
              shortcode += ' ' + sub_shortcode_tag.replace('-', '_') + '="' + sub_shortcode_value.toString() + '"';
            }

          });

        } else {

          shortcode += ' ' + shortcode_tag.replace('-', '_') + '="' + shortcode_value.toString() + '"';

        }

      }

      return shortcode;

    };

    base.insertAtChars = function (_this, currentValue) {

      var obj = (typeof _this[0].name !== 'undefined') ? _this[0] : _this;

      if (obj.value.length && typeof obj.selectionStart !== 'undefined') {
        obj.focus();
        return obj.value.substring(0, obj.selectionStart) + currentValue + obj.value.substring(obj.selectionEnd, obj.value.length);
      } else {
        obj.focus();
        return currentValue;
      }

    };

    base.send_to_editor = function (html, editor_id) {

      var tinymce_editor;

      if (typeof tinymce !== 'undefined') {
        tinymce_editor = tinymce.get(editor_id);
      }

      if (tinymce_editor && !tinymce_editor.isHidden()) {
        tinymce_editor.execCommand('mceInsertContent', false, html);
      } else {
        var $editor = $('#' + editor_id);
        $editor.val(base.insertAtChars($editor, html)).trigger('change');
      }

    };

    return this.each(function () {

      var $modal = $(this),
        $load = $modal.find('.wcgs-modal-load'),
        $content = $modal.find('.wcgs-modal-content'),
        $insert = $modal.find('.wcgs-modal-insert'),
        $loading = $modal.find('.wcgs-modal-loading'),
        $select = $modal.find('select'),
        modal_id = $modal.data('modal-id'),
        nonce = $modal.data('nonce'),
        editor_id,
        target_id,
        gutenberg_id,
        sc_key,
        sc_name,
        sc_view,
        sc_group,
        $cloned,
        $button;

      $(document).on('click', '.wcgs-shortcode-button[data-modal-id="' + modal_id + '"]', function (e) {

        e.preventDefault();

        $button = $(this);
        editor_id = $button.data('editor-id') || false;
        target_id = $button.data('target-id') || false;
        gutenberg_id = $button.data('gutenberg-id') || false;

        $modal.show();

        // single usage trigger first shortcode
        if ($modal.hasClass('wcgs-shortcode-single') && sc_name === undefined) {
          $select.trigger('change');
        }

      });

      $select.on('change', function () {

        var $option = $(this);
        var $selected = $option.find(':selected');

        sc_key = $option.val();
        sc_name = $selected.data('shortcode');
        sc_view = $selected.data('view') || 'normal';
        sc_group = $selected.data('group') || sc_name;

        $load.empty();

        if (sc_key) {

          $loading.show();

          window.wp.ajax.post('wcgs-get-shortcode-' + modal_id, {
            shortcode_key: sc_key,
            nonce: nonce
          })
            .done(function (response) {

              $loading.hide();

              var $appended = $(response.content).appendTo($load);

              $insert.parent().removeClass('hidden');

              $cloned = $appended.find('.wcgs--repeat-shortcode').wcgs_clone();

              $appended.wcgs_reload_script();
              $appended.find('.wcgs-fields').wcgs_reload_script();

            });

        } else {

          $insert.parent().addClass('hidden');

        }

      });

      $insert.on('click', function (e) {

        e.preventDefault();

        var shortcode = '';
        var serialize = $modal.find('.wcgs-field:not(.hidden)').find(':input:not(.ignore)').serializeObjectWCGS();

        switch (sc_view) {

          case 'contents':
            var contentsObj = (sc_name) ? serialize[sc_name] : serialize;
            $.each(contentsObj, function (sc_key, sc_value) {
              var sc_tag = (sc_name) ? sc_name : sc_key;
              shortcode += '[' + sc_tag + ']' + sc_value + '[/' + sc_tag + ']';
            });
            break;

          case 'group':

            shortcode += '[' + sc_name;
            $.each(serialize[sc_name], function (sc_key, sc_value) {
              shortcode += base.shortcode_tags(sc_key, sc_value);
            });
            shortcode += ']';
            shortcode += base.shortcode_parse(serialize[sc_group], sc_group);
            shortcode += '[/' + sc_name + ']';

            break;

          case 'repeater':
            shortcode += base.shortcode_parse(serialize[sc_group], sc_group);
            break;

          default:
            shortcode += base.shortcode_parse(serialize);
            break;

        }

        if (gutenberg_id) {

          var content = window.wcgs_gutenberg_props.attributes.hasOwnProperty('shortcode') ? window.wcgs_gutenberg_props.attributes.shortcode : '';
          window.wcgs_gutenberg_props.setAttributes({ shortcode: content + shortcode });

        } else if (editor_id) {

          base.send_to_editor(shortcode, editor_id);

        } else {

          var $textarea = (target_id) ? $(target_id) : $button.parent().find('textarea');
          $textarea.val(base.insertAtChars($textarea, shortcode)).trigger('change');

        }

        $modal.hide();

      });

      $modal.on('click', '.wcgs--repeat-button', function (e) {

        e.preventDefault();

        var $repeatable = $modal.find('.wcgs--repeatable');
        var $new_clone = $cloned.wcgs_clone();
        var $remove_btn = $new_clone.find('.wcgs-repeat-remove');

        var $appended = $new_clone.appendTo($repeatable);

        $new_clone.find('.wcgs-fields').wcgs_reload_script();

        WCGS.helper.name_nested_replace($modal.find('.wcgs--repeat-shortcode'), sc_group);

        $remove_btn.on('click', function () {

          $new_clone.remove();

          WCGS.helper.name_nested_replace($modal.find('.wcgs--repeat-shortcode'), sc_group);

        });

      });

      $modal.on('click', '.wcgs-modal-close, .wcgs-modal-overlay', function () {
        $modal.hide();
      });

    });
  };

  //
  // Helper Checkbox Checker
  //
  $.fn.wcgs_checkbox = function () {
    return this.each(function () {

      var $this = $(this),
        $input = $this.find('.wcgs--input'),
        $checkbox = $this.find('.wcgs--checkbox');

      $checkbox.on('click', function () {
        $input.val(Number($checkbox.prop('checked'))).trigger('change');
      });

    });
  };

  //
  // Field: wp_editor
  //
  $.fn.wcgs_field_wp_editor = function () {
    return this.each(function () {

      if (typeof window.wp.editor === 'undefined' || typeof window.tinyMCEPreInit === 'undefined' || typeof window.tinyMCEPreInit.mceInit.wcgs_wp_editor === 'undefined') {
        return;
      }

      var $this = $(this),
        $editor = $this.find('.wcgs-wp-editor'),
        $textarea = $this.find('textarea');

      // If there is wp-editor remove it for avoid dupliated wp-editor conflicts.
      var $has_wp_editor = $this.find('.wp-editor-wrap').length || $this.find('.mce-container').length;

      if ($has_wp_editor) {
        $editor.empty();
        $editor.append($textarea);
        $textarea.css('display', '');
      }

      // Generate a unique id
      var uid = WCGS.helper.uid('wcgs-editor-');

      $textarea.attr('id', uid);

      // Get default editor settings
      var default_editor_settings = {
        tinymce: window.tinyMCEPreInit.mceInit.wcgs_wp_editor,
        quicktags: window.tinyMCEPreInit.qtInit.wcgs_wp_editor
      };

      // Get default editor settings
      var field_editor_settings = $editor.data('editor-settings');

      // Add on change event handle
      var editor_on_change = function (editor) {
        editor.on('change', WCGS.helper.debounce(function () {
          editor.save();
          $textarea.trigger('change');
        }, 250));
      };

      // Callback for old wp editor
      var wpEditor = wp.oldEditor ? wp.oldEditor : wp.editor;

      if (wpEditor && wpEditor.hasOwnProperty('autop')) {
        wp.editor.autop = wpEditor.autop;
        wp.editor.removep = wpEditor.removep;
        wp.editor.initialize = wpEditor.initialize;
      }

      // Extend editor selector and on change event handler
      default_editor_settings.tinymce = $.extend({}, default_editor_settings.tinymce, { selector: '#' + uid, setup: editor_on_change });

      // Override editor tinymce settings
      if (field_editor_settings.tinymce === false) {
        default_editor_settings.tinymce = false;
        $editor.addClass('wcgs-no-tinymce');
      }

      // Override editor quicktags settings
      if (field_editor_settings.quicktags === false) {
        default_editor_settings.quicktags = false;
        $editor.addClass('wcgs-no-quicktags');
      }

      // Wait until :visible
      var interval = setInterval(function () {
        if ($this.is(':visible')) {
          window.wp.editor.initialize(uid, default_editor_settings);
          clearInterval(interval);
        }
      });

      // Add Media buttons
      if (field_editor_settings.media_buttons && window.wcgs_media_buttons) {

        var $editor_buttons = $editor.find('.wp-media-buttons');

        if ($editor_buttons.length) {

          $editor_buttons.find('.wcgs-shortcode-button').data('editor-id', uid);

        } else {

          var $media_buttons = $(window.wcgs_media_buttons);

          $media_buttons.find('.wcgs-shortcode-button').data('editor-id', uid);

          $editor.prepend($media_buttons);

        }

      }

    });

  };

  //
  // Siblings
  //
  $.fn.wcgs_siblings = function () {
    return this.each(function () {

      var $this = $(this),
        $siblings = $this.find('.wcgs--sibling:not(.wcgs-pro-only)'),
        multiple = $this.data('multiple') || false;
      $this.find('.wcgs--sibling.wcgs-pro-only').find('input').prop('disable', true)
      $siblings.on('click', function () {

        var $sibling = $(this);

        if (multiple) {

          if ($sibling.hasClass('wcgs--active')) {
            $sibling.removeClass('wcgs--active');
            $sibling.find('input').prop('checked', false).trigger('change');
          } else {
            $sibling.addClass('wcgs--active');
            $sibling.find('input').prop('checked', true).trigger('change');
          }

        } else {

          $this.find('input').prop('checked', false);
          $sibling.find('input').prop('checked', true).trigger('change');
          $sibling.addClass('wcgs--active').siblings().removeClass('wcgs--active');

        }

      });

    });
  };

  //
  // WP Color Picker
  //
  if (typeof Color === 'function') {

    Color.fn.toString = function () {

      if (this._alpha < 1) {
        return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
      }

      var hex = parseInt(this._color, 10).toString(16);

      if (this.error) { return ''; }

      if (hex.length < 6) {
        for (var i = 6 - hex.length - 1; i >= 0; i--) {
          hex = '0' + hex;
        }
      }

      return '#' + hex;

    };

  }

  WCGS.funcs.parse_color = function (color) {

    var value = color.replace(/\s+/g, ''),
      trans = (value.indexOf('rgba') !== -1) ? parseFloat(value.replace(/^.*,(.+)\)/, '$1') * 100) : 100,
      rgba = (trans < 100) ? true : false;

    return { value: value, transparent: trans, rgba: rgba };

  };

  $.fn.wcgs_color = function () {
    return this.each(function () {

      var $input = $(this),
        picker_color = WCGS.funcs.parse_color($input.val()),
        palette_color = window.wcgs_vars.color_palette.length ? window.wcgs_vars.color_palette : true,
        $container;

      // Destroy and Reinit
      if ($input.hasClass('wp-color-picker')) {
        $input.closest('.wp-picker-container').after($input).remove();
      }

      $input.wpColorPicker({
        palettes: palette_color,
        change: function (event, ui) {

          var ui_color_value = ui.color.toString();

          $container.removeClass('wcgs--transparent-active');
          $container.find('.wcgs--transparent-offset').css('background-color', ui_color_value);
          $input.val(ui_color_value).trigger('change');

        },
        create: function () {

          $container = $input.closest('.wp-picker-container');

          var a8cIris = $input.data('a8cIris'),
            $transparent_wrap = $('<div class="wcgs--transparent-wrap">' +
              '<div class="wcgs--transparent-slider"></div>' +
              '<div class="wcgs--transparent-offset"></div>' +
              '<div class="wcgs--transparent-text"></div>' +
              '<div class="wcgs--transparent-button button button-small">transparent</div>' +
              '</div>').appendTo($container.find('.wp-picker-holder')),
            $transparent_slider = $transparent_wrap.find('.wcgs--transparent-slider'),
            $transparent_text = $transparent_wrap.find('.wcgs--transparent-text'),
            $transparent_offset = $transparent_wrap.find('.wcgs--transparent-offset'),
            $transparent_button = $transparent_wrap.find('.wcgs--transparent-button');

          if ($input.val() === 'transparent') {
            $container.addClass('wcgs--transparent-active');
          }

          $transparent_button.on('click', function () {
            if ($input.val() !== 'transparent') {
              $input.val('transparent').trigger('change').removeClass('iris-error');
              $container.addClass('wcgs--transparent-active');
            } else {
              $input.val(a8cIris._color.toString()).trigger('change');
              $container.removeClass('wcgs--transparent-active');
            }
          });

          $transparent_slider.slider({
            value: picker_color.transparent,
            step: 1,
            min: 0,
            max: 100,
            slide: function (event, ui) {

              var slide_value = parseFloat(ui.value / 100);
              a8cIris._color._alpha = slide_value;
              $input.wpColorPicker('color', a8cIris._color.toString());
              $transparent_text.text((slide_value === 1 || slide_value === 0 ? '' : slide_value));

            },
            create: function () {

              var slide_value = parseFloat(picker_color.transparent / 100),
                text_value = slide_value < 1 ? slide_value : '';

              $transparent_text.text(text_value);
              $transparent_offset.css('background-color', picker_color.value);

              $container.on('click', '.wp-picker-clear', function () {

                a8cIris._color._alpha = 1;
                $transparent_text.text('');
                $transparent_slider.slider('option', 'value', 100);
                $container.removeClass('wcgs--transparent-active');
                $input.trigger('change');

              });

              $container.on('click', '.wp-picker-default', function () {

                var default_color = WCGS.funcs.parse_color($input.data('default-color')),
                  default_value = parseFloat(default_color.transparent / 100),
                  default_text = default_value < 1 ? default_value : '';

                a8cIris._color._alpha = default_value;
                $transparent_text.text(default_text);
                $transparent_slider.slider('option', 'value', default_color.transparent);

              });

              $container.on('click', '.wp-color-result', function () {
                $transparent_wrap.toggle();
              });

              $('body').on('click.wpcolorpicker', function () {
                $transparent_wrap.hide();
              });

            }
          });
        }
      });

    });
  };

  //
  // ChosenJS
  //
  $.fn.wcgs_chosen = function () {
    return this.each(function () {

      var $this = $(this),
        $inited = $this.parent().find('.chosen-container'),
        is_multi = $this.attr('multiple') || false,
        set_width = is_multi ? '100%' : 'auto',
        set_options = $.extend({
          allow_single_deselect: true,
          disable_search_threshold: 15,
          width: set_width
        }, $this.data());

      if ($inited.length) {
        $inited.remove();
      }

      $this.chosen(set_options);

    });
  };

  //
  // Number (only allow numeric inputs)
  //
  $.fn.wcgs_number = function () {
    return this.each(function () {

      $(this).on('keypress', function (e) {

        if (e.keyCode !== 0 && e.keyCode !== 8 && e.keyCode !== 45 && e.keyCode !== 46 && (e.keyCode < 48 || e.keyCode > 57)) {
          return false;
        }

      });

    });
  };

  //
  // Help Tooltip
  //
  $.fn.wcgs_help = function () {
    return this.each(function () {

      var $this = $(this),
        $tooltip,
        offset_left;

      $this.on({
        mouseenter: function () {

          $tooltip = $('<div class="wcgs-tooltip"></div>').html($this.find('.wcgs-help-text').html()).appendTo('body');
          offset_left = (WCGS.vars.is_rtl) ? ($this.offset().left + 24) : ($this.offset().left + 24);

          $tooltip.css({
            top: $this.offset().top - (($tooltip.outerHeight() / 2) - 14),
            left: offset_left,
            textAlign: 'left',
          });

        },
        mouseleave: function () {

          if ($tooltip !== undefined) {
            $tooltip.remove();
          }

        }

      });

    });
  };

  //
  // Customize Refresh
  //
  $.fn.wcgs_customizer_refresh = function () {
    return this.each(function () {

      var $this = $(this),
        $complex = $this.closest('.wcgs-customize-complex');

      if ($complex.length) {

        var $input = $complex.find(':input'),
          $unique = $complex.data('unique-id'),
          $option = $complex.data('option-id'),
          obj = $input.serializeObjectWCGS(),
          data = (!$.isEmptyObject(obj)) ? obj[$unique][$option] : '',
          control = wp.customize.control($unique + '[' + $option + ']');

        // clear the value to force refresh.
        control.setting._value = null;

        control.setting.set(data);

      } else {

        $this.find(':input').first().trigger('change');

      }

      $(document).trigger('wcgs-customizer-refresh', $this);

    });
  };

  //
  // Customize Listen Form Elements
  //
  $.fn.wcgs_customizer_listen = function (options) {

    var settings = $.extend({
      closest: false,
    }, options);

    return this.each(function () {

      if (window.wp.customize === undefined) { return; }

      var $this = (settings.closest) ? $(this).closest('.wcgs-customize-complex') : $(this),
        $input = $this.find(':input'),
        unique_id = $this.data('unique-id'),
        option_id = $this.data('option-id');

      if (unique_id === undefined) { return; }

      $input.on('change keyup', WCGS.helper.debounce(function () {

        var obj = $this.find(':input').serializeObjectWCGS();

        if (!$.isEmptyObject(obj) && obj[unique_id]) {

          window.wp.customize.control(unique_id + '[' + option_id + ']').setting.set(obj[unique_id][option_id]);

        }

      }, 250));

    });
  };

  //
  // Customizer Listener for Reload JS
  //
  $(document).on('expanded', '.control-section', function () {

    var $this = $(this);

    if ($this.hasClass('open') && !$this.data('inited')) {

      var $fields = $this.find('.wcgs-customize-field');
      var $complex = $this.find('.wcgs-customize-complex');

      if ($fields.length) {
        $this.wcgs_dependency();
        $fields.wcgs_reload_script({ dependency: false });
        $complex.wcgs_customizer_listen();
      }

      $this.data('inited', true);

    }

  });

  //
  // Window on resize
  //
  WCGS.vars.$window.on('resize wcgs.resize', WCGS.helper.debounce(function (event) {

    var window_width = navigator.userAgent.indexOf('AppleWebKit/') > -1 ? WCGS.vars.$window.width() : window.innerWidth;

    if (window_width <= 782 && !WCGS.vars.onloaded) {
      $('.wcgs-section').wcgs_reload_script();
      WCGS.vars.onloaded = true;
    }

  }, 200)).trigger('wcgs.resize');

  //
  // Widgets Framework
  //
  $.fn.wcgs_widgets = function () {
    if (this.length) {

      $(document).on('widget-added widget-updated', function (event, $widget) {
        $widget.find('.wcgs-fields').wcgs_reload_script();
      });

      $('.widgets-sortables, .control-section-sidebar').on('sortstop', function (event, ui) {
        ui.item.find('.wcgs-fields').wcgs_reload_script_retry();
      });

      $(document).on('click', '.widget-top', function (event) {
        $(this).parent().find('.wcgs-fields').wcgs_reload_script();
      });

    }
  };

  //
  // Retry Plugins
  //
  $.fn.wcgs_reload_script_retry = function () {
    return this.each(function () {

      var $this = $(this);

      if ($this.data('inited')) {
        $this.children('.wcgs-field-wp_editor').wcgs_field_wp_editor();
      }

    });
  };

  //
  // Reload Plugins
  //
  $.fn.wcgs_reload_script = function (options) {

    var settings = $.extend({
      dependency: true,
    }, options);

    return this.each(function () {

      var $this = $(this);

      // Avoid for conflicts
      if (!$this.data('inited')) {

        // Field plugins
        $this.children('.wcgs-field-accordion').wcgs_field_accordion();
        $this.children('.wcgs-field-background').wcgs_field_background();
        $this.children('.wcgs-field-code_editor').wcgs_field_code_editor();
        $this.children('.wcgs-field-date').wcgs_field_date();
        $this.children('.wcgs-field-fieldset').wcgs_field_fieldset();
        $this.children('.wcgs-field-gallery').wcgs_field_gallery();
        $this.children('.wcgs-field-group').wcgs_field_group();
        $this.children('.wcgs-field-media').wcgs_field_media();
        $this.children('.wcgs-field-repeater').wcgs_field_repeater();
        $this.children('.wcgs-field-slider').wcgs_field_slider();
        $this.children('.wcgs-field-sortable').wcgs_field_sortable();
        $this.children('.wcgs-field-sorter').wcgs_field_sorter();
        $this.children('.wcgs-field-spinner').wcgs_field_spinner();
        $this.children('.wcgs-field-switcher:not(.pro_switcher)').wcgs_field_switcher();
        $this.children('.wcgs-field-tabbed').wcgs_field_tabbed();
        $this.children('.wcgs-field-upload').wcgs_field_upload();
        $this.children('.wcgs-field-wp_editor').wcgs_field_wp_editor();

        // Field colors
        $this.children('.wcgs-field-border').find('.wcgs-color').wcgs_color();
        $this.children('.wcgs-field-background').find('.wcgs-color').wcgs_color();
        $this.children('.wcgs-field-color').find('.wcgs-color').wcgs_color();
        $this.children('.wcgs-field-color_group').find('.wcgs-color').wcgs_color();
        $this.children('.wcgs-field-link_color').find('.wcgs-color').wcgs_color();

        // Field allows only number
        $this.children('.wcgs-field-dimensions').find('.wcgs-number').wcgs_number();
        $this.children('.wcgs-field-slider').find('.wcgs-number').wcgs_number();
        $this.children('.wcgs-field-spacing').find('.wcgs-number').wcgs_number();
        $this.children('.wcgs-field-spinner').find('.wcgs-number').wcgs_number();

        // Field chosenjs
        $this.children('.wcgs-field-select').find('.wcgs-chosen').wcgs_chosen();

        // Field Checkbox
        $this.children('.wcgs-field-checkbox').find('.wcgs-checkbox').wcgs_checkbox();

        // Field Siblings
        $this.children('.wcgs-field-button_set').find('.wcgs-siblings').wcgs_siblings();
        $this.children('.wcgs-field-image_select').find('.wcgs-siblings').wcgs_siblings();
        $this.children('.wcgs-field-palette').find('.wcgs-siblings').wcgs_siblings();

        // Help Tooptip
        $this.children('.wcgs-field').find('.wcgs-help').wcgs_help();

        if (settings.dependency) {
          $this.wcgs_dependency();
        }

        $this.data('inited', true);

        $(document).trigger('wcgs-reload-script', $this);

      }

    });
  };

  //
  // Document ready and run scripts
  //
  $(document).ready(function () {

    $('.wcgs-save').wcgs_save();
    $('.wcgs-confirm').wcgs_confirm();
    $('.wcgs-nav-options').wcgs_nav_options();
    $('.wcgs-nav-metabox').wcgs_nav_metabox();
    $('.wcgs-expand-all').wcgs_expand_all();
    $('.wcgs-search').wcgs_search();
    $('.wcgs-sticky-header').wcgs_sticky();
    $('.wcgs-taxonomy').wcgs_taxonomy();
    $('.wcgs-shortcode').wcgs_shortcode();
    $('.wcgs-page-templates').wcgs_page_templates();
    $('.wcgs-post-formats').wcgs_post_formats();
    $('.wcgs-onload').wcgs_reload_script();
    $('.widget').wcgs_widgets();

  });
  jQuery('.wcgs-field-switcher.pro_switcher .wcgs--switcher, .pro_only_slider .wcgs-table-cell,.pro_only_color .wcgs-fieldset').on('click', function () {
    tb_show('', '#TB_inline?&width=410&height=225&inlineId=myOnPageContent');
  });
  /* Custom js */
  $("label:contains((Pro))").css({ 'pointer-events': 'none' });
  $("label:contains((Pro)) input, .pro_only_field input, .pro_checkbox input").attr('disabled', true).css('opacity', '0.8');
  $("select option:contains((Pro))").attr('disabled', true).css('opacity', '0.8');
  $(".pro_only_slider .wcgs-slider-ui").slider({ disabled: true });
  $(".pro_only_slider input").attr({ 'disabled': true, 'value': 1.5 }).css('opacity', '0.8');


  $(document).on('keyup change', '#wcgs-form', function (e)  { 
    e.preventDefault();
    var $button = $(this).find('.wcgs-save.wcgs-save-ajax');
    $button.css({"background-color": "#00C263", "pointer-events": "initial"}).val('Save Settings');
  });
  $(".wcgs-save").click(function(e) {
    e.preventDefault();
    $(this).css({"background-color": "#C5C5C6","pointer-events": "none"}).val('Changes Saved');
})
})(jQuery, window, document);
