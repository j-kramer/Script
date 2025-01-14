import Create from "./pages/Create.vue";
import Overview from "./pages/Overview.vue";

export default [
    {
        path: "/",
        name: "overview",
        component: Overview,
    },
    {
        path: "/create",
        name: "createBook",
        component: Create,
    },
];
