import {library, dom} from '@fortawesome/fontawesome-svg-core'
import {faBars} from "@fortawesome/free-solid-svg-icons/faBars";
import {faCircleNotch} from "@fortawesome/free-solid-svg-icons/faCircleNotch";
import {faCheck} from "@fortawesome/free-solid-svg-icons/faCheck";
import {faTimes} from "@fortawesome/free-solid-svg-icons/faTimes";

export default () => {
    library.add(faCircleNotch);
    library.add(faBars);
    library.add(faCheck);
    library.add(faTimes);

    dom.watch();
}
