import Create from "./pages/CreateAuthor.vue";
import Overview from "./pages/AuthorOverview.vue";
import Edit from "./pages/EditAuthor.vue";

export default [
    {
        path: "/authors",
        name: "authorOverview",
        component: Overview,
    },
    {
        path: "/authors/create",
        name: "createAuthor",
        component: Create,
    },
    {
        path: "/authors/edit/:id",
        name: "editAuthor",
        component: Edit,
    },
];
