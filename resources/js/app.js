require('./bootstrap');

import { createApp } from 'vue'
import Test from './components/Test'
import List_brand from './components/brand/List'

const app = createApp({})

app.component('test', Test)
app.component('List_brand', List_brand)



app.mount('#app')
