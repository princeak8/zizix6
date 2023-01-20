import { createApp } from "vue/dist/vue.esm-bundler.js";
import AppComponent from "./components/App.vue";
import Home from "./components/Home.vue";
import router from "./router/index";

const app = createApp({
    components: {
        AppComponent,
        Home,
    },
});

// app.mount("#app");
// app.use(router);
