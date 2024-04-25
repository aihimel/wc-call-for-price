import { createContext, useState } from 'react';
import { ARCHIVE_PAGE, URL_KEY } from "./constants";

export const WCPNavigationContext = createContext();

export default function WCPRouter( { children } ) {
    const [ navigation, setNavigation ] = useState({
        url_key: URL_KEY,
        current_page_key: ARCHIVE_PAGE
    });

    return(
        <WCPNavigationContext.Provider value={ { navigation, setNavigation } }>
            { children }
        </WCPNavigationContext.Provider>
    );
}