/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/front/google-maps.js":
/*!*******************************************!*\
  !*** ./resources/js/front/google-maps.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(window).ready(function () {
  var maps = {};
  map.liasaMap = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(41.2133132, 1.135152),
    zoom: 17,
    styles: [{
      "elementType": "labels.icon",
      "stylers": [{
        "visibility": "off"
      }]
    }, {
      "featureType": "administrative.land_parcel",
      "stylers": [{
        "visibility": "off"
      }]
    }]
  });
  /*----*/

  var liasacamiones = new google.maps.LatLng(41.2121516, 1.1346729);
  var liasacamionesBox = '<div id="content" class="d-flex" style="max-width:300px;">' + '<div class="w-50">' + '<figure style="overflow:hidden;">' + '<img src="../images/truck.jpg" style="width:90%;">' + '</figure>' + '</div>' + '<div class="w-50">' + '<address class="text-default">' + '<p class="text-xs">Avinguda de la Llibertat, 2, 43470 La Selva del Camp,Tarragona</p>' + "</address>" + '<a target="_blank" href="https://goo.gl/maps/zBj6GNU9YuXcGd8r6" class="text-primary"><u>Cómo llegar</u></a>' + "</div>" + "</div>";
  var infowindow2 = new google.maps.InfoWindow({
    content: liasacamionesBox
  });
  var liasaMarkerCamiones = new google.maps.Marker({
    position: liasacamiones,
    map: map.liasaMap,
    icon: "../images/marker.png",
    anchorPoint: new google.maps.Point(0, -13)
  });
  liasaMarkerCamiones.addListener("click", function () {
    infowindow2.open(map, liasaMarkerCamiones);
  });
  var liasaoficina = new google.maps.LatLng(41.2137305, 1.1340691);
  var liasaoficinaBox = '<div id="content" class="d-flex" style="max-width:300px;">' + '<div class="w-50">' + '<figure style="overflow:hidden;">' + '<img src="../images/factory1.jpg" style="width:90%;">' + '</figure>' + '</div>' + '<div class="w-50">' + '<address class="text-default">' + '<p class="text-xs">Raval de Sant Rafael, 21, 43470 La Selva del Camp,Tarragona</p>' + "</address>" + '<a target="_blank" href="https://goo.gl/maps/kKERg8woAoGVMcMeA" class="text-primary"><u>Cómo llegar</u></a>' + "</div>" + "</div>";
  var infowindow = new google.maps.InfoWindow({
    content: liasaoficinaBox
  });
  var liasaMarkerOficinas = new google.maps.Marker({
    position: liasaoficina,
    map: map.liasaMap,
    icon: "../images/marker.png",
    anchorPoint: new google.maps.Point(0, -13)
  });
  liasaMarkerOficinas.addListener("click", function () {
    infowindow.open(map, liasaMarkerOficinas);
  });
});

/***/ }),

/***/ 4:
/*!*************************************************!*\
  !*** multi ./resources/js/front/google-maps.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Library/WebServer/Documents/liasa/resources/js/front/google-maps.js */"./resources/js/front/google-maps.js");


/***/ })

/******/ });