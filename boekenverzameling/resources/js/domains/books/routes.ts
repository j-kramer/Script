import Create from "./pages/Create.vue";
import Overview from "./pages/Overview.vue";
import Edit from "./pages/Edit.vue";
import Show from "./pages/Show.vue";

export default [
    {
        path: "/books",
        children: [
            {
                path: "",
                name: "overview",
                component: Overview,
            },
            {
                path: "create",
                name: "createBook",
                component: Create,
            },
            {
                path: ":id",
                name: "showBook",
                component: Show,
            },
            {
                path: ":id/edit",
                name: "editBook",
                component: Edit,
            },
        ],
    },
];
