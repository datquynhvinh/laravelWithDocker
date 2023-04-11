/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat-layout', require('./components/ChatLayout.vue').default)

const app = new Vue({
    el: '#app',
    data: {
        currentUserLogin: {}
    },
    created() {
        this.getCurrentUserLogin()
    },
    methods: {
        async getCurrentUserLogin() {
            try {
                const response = await axios.get('/users/user-info')
                this.currentUserLogin = response.data
            } catch (error) {
                console.log(error)
            }
        }
    }
})