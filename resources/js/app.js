/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(function() {
    var options = {
        // 当滚动到底部时,自动加载下一页
        autoTrigger: false,
        // 限制自动加载, 仅限前两页, 后面就要用户点击才加载
        autoTriggerUntil: 2,
        // 设置加载下一页缓冲时的图片
        loadingHtml: '<p style="text-align: center"><div class="spinner-border text-info" role="status"> <span class="sr-only">Loading...</span> </div>正在加载中...</p>',
        //设置距离底部多远时开始加载下一页
        padding: 0,
        nextSelector: 'a.jscroll-next:last',
        // 下一个自动加载的位置
        contentSelector: 'div.infinite-scroll'
    };

    $('.infinite-scroll').jscroll(options);
});
