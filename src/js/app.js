import {
    useState
} from 'react';

import {
    createBrowserRouter,
    RouterProvider
} from "react-router-dom";

import WCPNavigation from "./wcp-navigation";

export function Dashboard({}) {
    const _URL = new URL( window.location );
    let current_page_slug = _URL.searchParams.get('dashboard-screen') !== "" ? _URL.searchParams.get('dashboard-screen') : "home";

    let content = <></>
    switch ( current_page_slug ) {
        case "page_two":
            content = <>Page Two</>
            break;
        case "page_three":
            content = <>Page Three</>
        default:
            content = <>Page One</>
    }
    return(
        <>
            <WCPNavigation />
            {content}
        </>
    );
}

const router = createBrowserRouter([
    {
        path: '/wp-admin/admin.php',
        element: <Dashboard />
    }
]);

export function App({}) {
    return(
        <RouterProvider router={router} />
    );
}

