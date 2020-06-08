/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.moment = require("moment");

// import component and stylesheet
import AirbnbStyleDatepicker from "vue-airbnb-style-datepicker";
import "vue-airbnb-style-datepicker/dist/vue-airbnb-style-datepicker.min.css";

// see docs for available options
const datepickerOptions = {};

// make sure we can use it in our components
Vue.use(AirbnbStyleDatepicker, datepickerOptions);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component("deletebutton", require("./components/DeleteButton.vue").default);
Vue.component("vehicleindex", require("./components/VehicleIndex.vue").default);
Vue.component("searchbar", require("./components/SearchBar.vue").default);
Vue.component("ordercounter", require("./components/OrderCounter.vue").default);
Vue.component("clientslist", require("./components/ClientsList.vue").default);
Vue.component(
    "admintoppanel",
    require("./components/AdminTopPanel.vue").default
);
Vue.component("userlist", require("./components/UserList.vue").default);
Vue.component(
    "userrolesbutton",
    require("./components/UserRolesButton.vue").default
);
Vue.component("vehiclegroup", require("./components/VehicleGroup.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
