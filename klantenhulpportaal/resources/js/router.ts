import { addRoutes } from "./services/router";

addRoutes([
    {
        path: "/",
        name: "home",
        redirect: "/users",
    },
]);
