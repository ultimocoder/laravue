require('./bootstrap');
import swal from 'sweetalert2';
window.Swal = swal;
    import {createApp} from 'vue';
    import Test from './components/Test.vue';
    import Dashboard from './components/Dashboard.vue';
    import Category from './components/Category.vue';
    import Showcategory from './components/Showcategory.vue';
    import Showsubcategory from './components/Showsubcategory.vue';
    import Subcategory from './components/Subcategory.vue';

window.$ = window.jQuery = require('jQuery');

const app = createApp({})
app.component('test' , Test);
app.component('dashboard' , Dashboard);
app.component('category' , Category);
app.component('showcategory' , Showcategory);
app.component('showsubcategory' , Showsubcategory);
app.component('subcategory' , Subcategory);
app.mount("#app")