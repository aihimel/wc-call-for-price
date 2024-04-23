import { createContext, useState } from 'react';

export const PageContext = createContext();

export default function WCPRouter( { children } ) {
    const [ current_slug, set_current_slug ] = useState( '' );
    return(
        <PageContext.Provider value={ { current_slug, set_current_slug } }>
            { children }
        </PageContext.Provider>
    );
}