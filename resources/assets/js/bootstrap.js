try {
    window.$ = window.jQuery = require('jquery');
    window.fastclick = require('fastclick');
    require('bootstrap-less/js/bootstrap.min.js');
} catch (e) {
  console.error(e);
}
