import { createContext, useState } from 'react';
import RuleArchive from "./rule-archive";
import { URL_KEY, ARCHIVE_PAGE } from "./constants";
import WCPRouter from "./wcp-router";

export const GlobalDataContext = createContext();



export default function Dashboard({}) {
    const [wcpGlobalData, setWcpGlobalData] = useState({
        navigation: {
            current_page_key: URL_KEY,
            current_page_slug: ARCHIVE_PAGE,
        }
    });
    return(
        <GlobalDataContext.Provider value={ { wcpGlobalData, setWcpGlobalData } }>
            <div className='wcp-dashboard-header'>Header Section</div>
            <WCPRouter>
                <div className='wcp-dashboard-content'>
                    <RuleArchive />
                </div>
            </WCPRouter>
        </GlobalDataContext.Provider>
    );
}