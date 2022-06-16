/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/styl/site.styl":
/*!****************************!*\
  !*** ./src/styl/site.styl ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styl_site_styl__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../styl/site.styl */ "./src/styl/site.styl");
 // import styl for webpack

/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */

/* global $, WP, Masonry */

var Site = {
  mobileThreshold: 601,
  init: function init() {
    var _this = this;

    $(window).resize(function () {
      _this.onResize();
    });
    $(document).ready(function () {});
    Site.Masonry.init();
    Site.Enquiry.init();
  },
  onResize: function onResize() {},
  fixWidows: function fixWidows() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function () {
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/, '&nbsp;$1');
      $(this).html(string);
    });
  }
};
Site.Enquiry = {
  $forms: $('.contact-form'),
  init: function init() {
    var _this = this;

    if (_this.$forms.length) {
      _this.bind();
    }
  },
  bind: function bind() {
    var _this = this;

    _this.$forms.on({
      'submit': function submit(e) {
        e.preventDefault();
        var data = $(this).serializeArray().reduce(function (obj, item) {
          obj[item.name] = item.value;
          return obj;
        }, {});

        _this.submitForm(this, data);
      }
    });
  },
  submitForm: function submitForm(form, data) {
    var _this = this; // validate and notify


    if (data.from === '' || data.copy === '') {
      _this.warnInvalid(form);
    } else {
      _this.unwarnInvalid(form);

      _this.makeRequest(data, form);

      $(form).find('input[type=submit]').attr('disabled', 'disabled');
    }
  },
  warnInvalid: function warnInvalid(form) {
    $(form).addClass('invalid');
  },
  unwarnInvalid: function unwarnInvalid(form) {
    $(form).removeClass('invalid');
  },
  makeRequest: function makeRequest(data, form) {
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
      success: function success(response, status) {
        _this.handleResponse(response, status, form);
      }
    });
  },
  handleResponse: function handleResponse(response, status, form) {
    var _this = this;

    if (response.type === 'error') {
      _this.handleError(response.error, form);
    } else if (response.type === 'success') {
      $(form).addClass('thanks');
    }
  },
  handleError: function handleError(error, form) {
    var $form = $(form);
    console.log('Error!', error);
    $form.addClass('error');
    $form.find('.error-message').text(error.message);
  }
};
Site.Masonry = {
  $container: $('#masonry-container'),
  instance: undefined,
  init: function init() {
    var _this = this;

    if (_this.$container.length) {
      _this.createInstance();
    }
  },
  createInstance: function createInstance() {
    var _this = this;

    _this.instance = new Masonry(_this.$container[0], {
      itemSelector: '.grid-item',
      transitionDuration: 0
    });

    _this.$container.imagesLoaded(function () {
      _this.instance.layout();
    });

    _this.$container.find('img').each(function (index, item) {
      $(item).on('load', function () {
        _this.instance.layout();
      });
    });
  }
};
Site.init();
})();

/******/ })()
;
//# sourceMappingURL=main.js.map