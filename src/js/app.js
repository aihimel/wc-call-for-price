import {
    useState
} from 'react';

import {
    createBrowserRouter,
    RouterProvider
} from "react-router-dom";

import WCPNavigation from "./wcp-navigation";
import WCPPage from "./wcp-page";

const router = createBrowserRouter([
    {
        path: '/wp-admin/admin.php',
        element: <><WCPNavigation /><WCPPage /></>
    }
]);

export function App({}) {
    return(
        <RouterProvider router={router} />
    );
}

