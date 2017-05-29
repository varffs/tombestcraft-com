/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, document, Site */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

    });

    Site.Masonry.init();
    Site.Enquery.init();

  },

  onResize: function() {
    var _this = this;

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

Site.Enquery = {
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

        _this.submitForm(data);

      }
    })
  },

  submitForm: function(data) {
    var _this = this;

    // validate and notify

    // make ajax request
    _this.makeRequest(data);
  },

  makeRequest: function(data) {
    var _this = this;

    console.log(data);

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
        _this.handleResponse(response, status);
      }
    });

  },

  handleResponse: function(response, status) {

    if (response.type === 'error') {

    } else {

    }
    console.log('response', response);

  },
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