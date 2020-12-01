import PlanList from "./Components/PlanList";
import PlanForm from "./Components/PlanForm";

Architect.onBoot((Vue) => {
   Vue.component('invitation-booking-details-list', PlanList);
   Vue.component('invitation-booking-details-form', PlanForm);
});
