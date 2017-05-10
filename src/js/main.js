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