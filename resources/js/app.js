require('./bootstrap');
import swal from 'sweetalert2';
window.Swal = swal;
    import {createApp} from 'vue';
    import Test from './components/Test.vue';
    import Dashboard from './components/Dashboard.vue';
    import Category from './components/Category.vue';
    import Showcategory from './components/Showcategory.vue';

window.$ = window.jQuery = require('jQuery');

const app = createApp({})
app.component('test' , Test);
app.component('dashboard' , Dashboard);
app.component('category' , Category);
app.component('showcategory' , Showcategory);
app.mount("#app")