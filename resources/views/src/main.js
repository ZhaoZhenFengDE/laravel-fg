'use strict';

var _vue = require('vue');

var _vue2 = _interopRequireDefault(_vue);

var _App = require('./App');

var _App2 = _interopRequireDefault(_App);

var _router = require('./router');

var _router2 = _interopRequireDefault(_router);

var _elementUi = require('element-ui');

var _elementUi2 = _interopRequireDefault(_elementUi);

require('element-ui/lib/theme-default/index.css');

var _axios = require('axios');

var _axios2 = _interopRequireDefault(_axios);

var _vueAxios = require('vue-axios');

var _vueAxios2 = _interopRequireDefault(_vueAxios);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_vue2.default.config.productionTip = false;
_vue2.default.use(_elementUi2.default);
_vue2.default.use(_axios2.default, _vueAxios2.default);

new _vue2.default({
    el: '#app',
    router: _router2.default,
    template: '<App/>',
    components: { App: _App2.default }
});
//# sourceMappingURL=main.js.map