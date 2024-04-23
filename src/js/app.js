import {
    useState
} from 'react';

import {
    createBrowserRouter,
    RouterProvider
} from "react-router-dom";

import WCPRouter from "./wcp-router";
import WCPNavigation from "./wcp-navigation";
import WCPPage from "./wcp-page";

// @TODO Add a WCPRouter wrapper context and pass data between components. Make the custom router functionality
// @TODO Create a custom form
// @TODO Save the form data
// @TODO Load the default data structure with wp_localize script
// @TODO Update the localize script data with hooks
// @TODO Create the entire flow Rule > Display > Action

const router = createBrowserRouter([
    {
        path: '/wp-admin/admin.php',
        element:
            <WCPRouter>
                <WCPNavigation />
                <WCPPage />
            </WCPRouter>
    }
]);

export function App({}) {
    return(
        <RouterProvider router={router} />
    );
}

