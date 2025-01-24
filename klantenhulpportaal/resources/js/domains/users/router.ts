import { addRoutes, createRoute } from "../../services/router";
import Overview from "./pages/UserOverview.vue";

addRoutes([createRoute("userOverview", "/users", Overview)]);
