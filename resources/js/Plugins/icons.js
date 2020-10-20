import {library, dom} from '@fortawesome/fontawesome-svg-core'
import {faSpinner} from "@fortawesome/free-solid-svg-icons/faSpinner";
import {faBars} from "@fortawesome/free-solid-svg-icons/faBars";

export default () => {
    library.add(faSpinner);
    library.add(faBars);

    dom.watch();
}
