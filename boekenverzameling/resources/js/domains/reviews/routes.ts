import EditReview from "./pages/EditReview.vue";
import CreateReview from "./pages/CreateReview.vue";

export default [
    {
        path: "/books/:id/create_review",
        name: "createReview",
        component: CreateReview,
    },
    {
        path: "/reviews/:id/edit",
        name: "editReview",
        component: EditReview,
    },
];
