'use strict';

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _vue = require('vue');

var _vue2 = _interopRequireDefault(_vue);

var _vueRouter = require('vue-router');

var _vueRouter2 = _interopRequireDefault(_vueRouter);

var _CheckOut = require('@/components/CheckOut');

var _CheckOut2 = _interopRequireDefault(_CheckOut);

var _IndexPage = require('@/components/IndexPage');

var _IndexPage2 = _interopRequireDefault(_IndexPage);

var _ProductsList = require('@/components/ProductsList');

var _ProductsList2 = _interopRequireDefault(_ProductsList);

var _ProductsDetail = require('@/components/ProductsDetail');

var _ProductsDetail2 = _interopRequireDefault(_ProductsDetail);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_vue2.default.use(_vueRouter2.default);

exports.default = new _vueRouter2.default({
    routes: [{
        path: '/',
        name: 'IndexPage',
        component: _IndexPage2.default
    }, {
        path: '/productlist',
        name: 'ProductsList',
        component: _ProductsList2.default
    }, {
        path: '/pud',
        name: 'ProductsDetail',
        component: _ProductsDetail2.default
    }, {
        path: '/checkout',
        name: 'CheckOut',
        component: _CheckOut2.default
    }]
});
//# sourceMappingURL=index.js.map