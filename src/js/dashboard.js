import { createContext, useState } from 'react';
import RuleArchive from "./rule-archive";
import SingleRule from "./single-rule";
import { URL_KEY, ADD_EDIT_PAGE } from "./constants";

export const GlobalDataContext = createContext();



export default function Dashboard({}) {

    let _URL = new URL(window.location);
    let current_page = _URL.searchParams.get( URL_KEY );

    const [wcpGlobalData, setWcpGlobalData] = useState({
        navigation: {
            current_page_key: URL_KEY,
            current_page_slug: current_page,
        }
    });

    let content = <RuleArchive />
    if (wcpGlobalData.navigation.current_page_slug === ADD_EDIT_PAGE) {
        content = <SingleRule />
    }

    return(
        <GlobalDataContext.Provider value={ { wcpGlobalData, setWcpGlobalData } }>
            <div className='wcp-dashboard-header'>Header Section</div>
            <div className='wcp-dashboard-content'>
                { content }
            </div>
        </GlobalDataContext.Provider>
    );
}