import { createRoot } from "react-dom/client";

import Dashboard from "./dashboard";

window.addEventListener(
    'load',
    function() {
        createRoot(
            document.querySelector( '#wcp-admin-settings-app' )
        ).render( <Dashboard /> );
    }, false
);