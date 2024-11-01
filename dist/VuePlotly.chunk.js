(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["VuePlotly"],{

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options!./src/components/VuePlotly.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _plotly_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../plotly.js */ \"./src/plotly.js\");\n/* harmony import */ var _plotly_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_plotly_js__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var lodash_debounce__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash/debounce */ \"./node_modules/lodash/debounce.js\");\n/* harmony import */ var lodash_debounce__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash_debounce__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var lodash_defaults__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! lodash/defaults */ \"./node_modules/lodash/defaults.js\");\n/* harmony import */ var lodash_defaults__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(lodash_defaults__WEBPACK_IMPORTED_MODULE_2__);\n//\n//\n//\n//\n//\n//\n\n\n\n\n\nvar events = ['click', 'hover', 'unhover', 'selecting', 'selected', 'restyle', 'relayout', 'autosize', 'deselect', 'doubleclick', 'redraw', 'animated'];\n\n// const functions = [\n//   'restyle',\n//   'relayout',\n//   'update',\n//   'addTraces',\n//   'deleteTraces',\n//   'moveTraces',\n//   'extendTraces',\n//   'prependTraces',\n//   'purge'\n// ]\n\n// const methods = functions.reduce((all, funcName) => {\n//   all[funcName] = function (...args) {\n//     return Plotly[funcName].apply(Plotly, [this.$refs.container].concat(args))\n//   }\n//   return all\n// }, {})\n\n/* harmony default export */ __webpack_exports__[\"default\"] = ({\n  name: 'VuePlotly',\n  props: {\n    autoResize: {\n      type: Boolean,\n      default: false\n    },\n    watchShallow: {\n      type: Boolean,\n      default: false\n    },\n    options: {\n      type: Object,\n      default: function _default() {\n        return {};\n      }\n    },\n    data: {\n      type: Array,\n      default: function _default() {\n        return [];\n      }\n    },\n    layout: {\n      type: Object,\n      default: function _default() {\n        return {};\n      }\n    }\n  },\n  data: function data() {\n    return {\n      internalLayout: this.layout\n    };\n  },\n  mounted: function mounted() {\n    this.newPlot();\n    this.initEvents();\n\n    this.$watch('data', this.newPlot, { deep: !this.watchShallow });\n    this.$watch('options', this.newPlot, { deep: !this.watchShallow });\n    this.$watch('layout', this.relayout, { deep: !this.watchShallow });\n  },\n  beforeDestroy: function beforeDestroy() {\n    var _this = this;\n\n    window.removeEventListener('resize', this.__resizeListener);\n    this.__generalListeners.forEach(function (obj) {\n      return _this.$refs.container.removeAllListeners(obj.fullName);\n    });\n    _plotly_js__WEBPACK_IMPORTED_MODULE_0___default.a.purge(this.$refs.container);\n  },\n\n  methods: {\n    initEvents: function initEvents() {\n      var _this2 = this;\n\n      if (this.autoResize) {\n        this.__resizeListener = lodash_debounce__WEBPACK_IMPORTED_MODULE_1___default()(this.plot, 200);\n        window.addEventListener('resize', this.__resizeListener);\n      }\n\n      this.__generalListeners = events.map(function (eventName) {\n        return {\n          fullName: 'plotly_' + eventName,\n          handler: function handler() {\n            for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {\n              args[_key] = arguments[_key];\n            }\n\n            _this2.$emit.apply(_this2, [eventName].concat(args));\n          }\n        };\n      });\n\n      this.__generalListeners.forEach(function (obj) {\n        _this2.$refs.container.on(obj.fullName, obj.handler);\n      });\n    },\n\n    // ...methods,\n    toImage: function toImage(options) {\n      var el = this.$refs.container;\n      var opts = lodash_defaults__WEBPACK_IMPORTED_MODULE_2___default()(options, {\n        format: 'png',\n        width: el.clientWidth,\n        height: el.clientHeight\n      });\n\n      return _plotly_js__WEBPACK_IMPORTED_MODULE_0___default.a.toImage(this.$refs.container, opts);\n    },\n    downloadImage: function downloadImage(options) {\n      var el = this.$refs.container;\n      var opts = lodash_defaults__WEBPACK_IMPORTED_MODULE_2___default()(options, {\n        format: 'png',\n        width: el.clientWidth,\n        height: el.clientHeight,\n        filename: (el.layout.title || 'plot') + ' - ' + new Date().toISOString()\n      });\n\n      return _plotly_js__WEBPACK_IMPORTED_MODULE_0___default.a.downloadImage(this.$refs.container, opts);\n    },\n    plot: function plot() {\n      return _plotly_js__WEBPACK_IMPORTED_MODULE_0___default.a.plot(this.$refs.container, this.data, this.internalLayout, this.options);\n    },\n    newPlot: function newPlot() {\n      return _plotly_js__WEBPACK_IMPORTED_MODULE_0___default.a.newPlot(this.$refs.container, this.data, this.internalLayout, this.options);\n    }\n  }\n});\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?./node_modules/babel-loader/lib!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css& ***!
  \************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("exports = module.exports = __webpack_require__(/*! ../../node_modules/css-loader/lib/css-base.js */ \"./node_modules/css-loader/lib/css-base.js\")(false);\n// imports\n\n\n// module\nexports.push([module.i, \"\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\\n\", \"\"]);\n\n// exports\n\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=template&id=a621e558&":
/*!***************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./src/components/VuePlotly.vue?vue&type=template&id=a621e558& ***!
  \***************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return render; });\n/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return staticRenderFns; });\nvar render = function() {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\"div\", { ref: \"container\", staticClass: \"vue-plotly\" })\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css& ***!
  \********************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("// style-loader: Adds some css to the DOM by adding a <style> tag\n\n// load the styles\nvar content = __webpack_require__(/*! !../../node_modules/css-loader!../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=style&index=0&lang=css& */ \"./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&\");\nif(typeof content === 'string') content = [[module.i, content, '']];\nif(content.locals) module.exports = content.locals;\n// add the styles to the DOM\nvar add = __webpack_require__(/*! ../../node_modules/vue-style-loader/lib/addStylesClient.js */ \"./node_modules/vue-style-loader/lib/addStylesClient.js\").default\nvar update = add(\"4b6ba844\", content, false, {});\n// Hot Module Replacement\nif(true) {\n // When the styles change, update the <style> tags\n if(!content.locals) {\n   module.hot.accept(/*! !../../node_modules/css-loader!../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=style&index=0&lang=css& */ \"./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&\", function() {\n     var newContent = __webpack_require__(/*! !../../node_modules/css-loader!../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=style&index=0&lang=css& */ \"./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&\");\n     if(typeof newContent === 'string') newContent = [[module.i, newContent, '']];\n     update(newContent);\n   });\n }\n // When the module is disposed, remove the <style> tags\n module.hot.dispose(function() { update(); });\n}\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?./node_modules/vue-style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib??vue-loader-options");

/***/ }),

/***/ "./src/components/VuePlotly.vue":
/*!**************************************!*\
  !*** ./src/components/VuePlotly.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VuePlotly.vue?vue&type=template&id=a621e558& */ \"./src/components/VuePlotly.vue?vue&type=template&id=a621e558&\");\n/* harmony import */ var _VuePlotly_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./VuePlotly.vue?vue&type=script&lang=js& */ \"./src/components/VuePlotly.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport *//* harmony import */ var _VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./VuePlotly.vue?vue&type=style&index=0&lang=css& */ \"./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&\");\n/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ \"./node_modules/vue-loader/lib/runtime/componentNormalizer.js\");\n\n\n\n\n\n\n/* normalize component */\n\nvar component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__[\"default\"])(\n  _VuePlotly_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n  _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n  _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"],\n  false,\n  null,\n  null,\n  null\n  \n)\n\n/* hot reload */\nif (true) {\n  var api = __webpack_require__(/*! ./node_modules/vue-hot-reload-api/dist/index.js */ \"./node_modules/vue-hot-reload-api/dist/index.js\")\n  api.install(__webpack_require__(/*! vue */ \"./node_modules/vue/dist/vue.runtime.esm.js\"))\n  if (api.compatible) {\n    module.hot.accept()\n    if (!module.hot.data) {\n      api.createRecord('a621e558', component.options)\n    } else {\n      api.reload('a621e558', component.options)\n    }\n    module.hot.accept(/*! ./VuePlotly.vue?vue&type=template&id=a621e558& */ \"./src/components/VuePlotly.vue?vue&type=template&id=a621e558&\", function(__WEBPACK_OUTDATED_DEPENDENCIES__) { /* harmony import */ _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VuePlotly.vue?vue&type=template&id=a621e558& */ \"./src/components/VuePlotly.vue?vue&type=template&id=a621e558&\");\n(function () {\n      api.rerender('a621e558', {\n        render: _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"render\"],\n        staticRenderFns: _VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]\n      })\n    })(__WEBPACK_OUTDATED_DEPENDENCIES__); })\n  }\n}\ncomponent.options.__file = \"src/components/VuePlotly.vue\"\n/* harmony default export */ __webpack_exports__[\"default\"] = (component.exports);\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?");

/***/ }),

/***/ "./src/components/VuePlotly.vue?vue&type=script&lang=js&":
/*!***************************************************************!*\
  !*** ./src/components/VuePlotly.vue?vue&type=script&lang=js& ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/babel-loader/lib!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=script&lang=js& */ \"./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=script&lang=js&\");\n/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_babel_loader_lib_index_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[\"default\"]); \n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?");

/***/ }),

/***/ "./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************!*\
  !*** ./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/vue-style-loader!../../node_modules/css-loader!../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=style&index=0&lang=css& */ \"./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=style&index=0&lang=css&\");\n/* harmony import */ var _node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);\n/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));\n /* harmony default export */ __webpack_exports__[\"default\"] = (_node_modules_vue_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); \n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?");

/***/ }),

/***/ "./src/components/VuePlotly.vue?vue&type=template&id=a621e558&":
/*!*********************************************************************!*\
  !*** ./src/components/VuePlotly.vue?vue&type=template&id=a621e558& ***!
  \*********************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../node_modules/vue-loader/lib??vue-loader-options!./VuePlotly.vue?vue&type=template&id=a621e558& */ \"./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./src/components/VuePlotly.vue?vue&type=template&id=a621e558&\");\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"render\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"render\"]; });\n\n/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, \"staticRenderFns\", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VuePlotly_vue_vue_type_template_id_a621e558___WEBPACK_IMPORTED_MODULE_0__[\"staticRenderFns\"]; });\n\n\n\n//# sourceURL=webpack:///./src/components/VuePlotly.vue?");

/***/ }),

/***/ "./src/plotly.js":
/*!***********************!*\
  !*** ./src/plotly.js ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar Plotly = __webpack_require__(/*! ../node_modules/plotly.js/lib/core */ \"./node_modules/plotly.js/lib/core.js\");\n\nPlotly.register([__webpack_require__(/*! ../node_modules/plotly.js/lib/bar */ \"./node_modules/plotly.js/lib/bar.js\"), __webpack_require__(/*! ../node_modules/plotly.js/lib/scatter */ \"./node_modules/plotly.js/lib/scatter.js\")]);\n\nmodule.exports = Plotly;\n\n//# sourceURL=webpack:///./src/plotly.js?");

/***/ }),

/***/ 1:
/*!***********************!*\
  !*** vertx (ignored) ***!
  \***********************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/* (ignored) */\n\n//# sourceURL=webpack:///vertx_(ignored)?");

/***/ })

}]);