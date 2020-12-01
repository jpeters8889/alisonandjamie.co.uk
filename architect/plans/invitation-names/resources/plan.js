import PlanList from "./Components/PlanList";
import PlanForm from "./Components/PlanForm";

Architect.onBoot((Vue) => {
   Vue.component('invitation-names-list', PlanList);
   Vue.component('invitation-names-form', PlanForm);
});
