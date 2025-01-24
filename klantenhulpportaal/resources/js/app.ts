import "./bootstrap";

import { createApp } from "vue";
import router from "./services/router";
import App from "./App.vue";

// Init routes & domains
import "./router";
import "./domains/users";

const app = createApp(App);
app.use(router);
app.mount("#app");
