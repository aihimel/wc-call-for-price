import { createRoot } from "react-dom/client";

import { App } from "./app";

window.addEventListener(
    'load',
    function() {
        createRoot(
            document.querySelector( '#wcp-admin-react-app' )
        ).render( <App /> );
    }, false
);