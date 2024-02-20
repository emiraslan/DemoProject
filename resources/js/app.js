import './bootstrap';

import { createApp } from "vue";
import ExampleComponent from "./components/ExampleComponent.vue";

// Vuetify
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
    components,
    directives
})

const app = createApp({
    components: {
        ExampleComponent,
    }
})

app.use(vuetify);

app.mount("#app");
