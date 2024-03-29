import '../styl/site.styl'; // import styl for webpack

import 'lazysizes';

import $ from 'jquery';
import jQueryBridget from 'jquery-bridget';
import imagesLoaded from 'imagesloaded';
import Masonry from 'masonry-layout';

jQueryBridget( 'imagesLoaded', imagesLoaded, $ );

/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global WP */

const Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

    });

    Site.Masonry.init();
    Site.Enquiry.init();

  },

  onResize: function() {

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Enquiry = {
  $forms: $('.contact-form'),
  init: function() {
    var _this = this;

    if (_this.$forms.length) {
      _this.bind();
    }

  },

  bind: function() {
    var _this = this;

    _this.$forms.on({
      'submit': function(e) {
        e.preventDefault();

        var data = $(this).serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
        }, {});

        _this.submitForm(this, data);

      }
    });
  },

  submitForm: function(form, data) {
    var _this = this;

    // validate and notify
    if (data.from === '' || data.copy === '') {
      _this.warnInvalid(form);
    } else {
      _this.unwarnInvalid(form);
      _this.makeRequest(data, form);
      $(form).find('input[type=submit]').attr('disabled', 'disabled');
    }
  },

  warnInvalid: function(form) {
    $(form).addClass('invalid');
  },

  unwarnInvalid: function(form) {
    $(form).removeClass('invalid');
  },

  makeRequest: function(data, form) {
    var _this = this;
    var requestData = {
      'action': 'send_enquiry',
      'nonce': data.nonce,
      'data': data
    };

    $.ajax({
      url: WP.ajaxUrl,
      type: 'post',
      data: requestData,
      success: function(response, status) {
        _this.handleResponse(response, status, form);
      }
    });
  },

  handleResponse: function(response, status, form) {
    var _this = this;

    if (response.type === 'error') {
      _this.handleError(response.error, form);
    } else if (response.type === 'success') {
      $(form).addClass('thanks');
    }

  },

  handleError: function(error, form) {
    var $form = $(form);

    console.log('Error!', error);

    $form.addClass('error');
    $form.find('.error-message').text(error.message);
  }
};

Site.Masonry = {
  $container: $('#masonry-container'),
  instance: undefined,

  init: function() {
    var _this = this;

    if (_this.$container.length) {
      _this.createInstance();
    }
  },

  createInstance: function() {
    var _this = this;

    _this.instance = new Masonry(_this.$container[0], {
      itemSelector: '.grid-item',
      transitionDuration: 0,
      percentPosition: true,
    });

    _this.$container.imagesLoaded(function() {
      _this.instance.layout();
    });

    _this.$container.find('img').each(function(index, item) {
      $(item).on('load', function() {
        _this.instance.layout();
      });
    });

  }
};

Site.init();