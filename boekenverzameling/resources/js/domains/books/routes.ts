import Create from "./pages/Create.vue";
import Overview from "./pages/Overview.vue";
import Edit from "./pages/Edit.vue";

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
    {
      path: '/edit/:id',
      name: 'editBook',
      component: Edit,
    },
];
