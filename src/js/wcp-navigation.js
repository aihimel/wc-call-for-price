import { useState } from "react";

export default function WCPNavigation({}){
    const [ current_slug, set_current_slug ] = useState("page_one");
    const handleClick = ( e ) => {
        e.preventDefault();
        set_current_slug( e.target.getAttribute('data-value') );
        let _URL = new URL(window.location);
        _URL.searchParams.set('dashboard-screen', e.target.getAttribute('data-value') );
        history.replaceState( null, '', _URL.toString() );
    }
    return(
        <ul>
            <li><a href='#' data-value='page_one' className={current_slug === 'page_one' ? 'active' : ''} value='page_one' onClick={handleClick}>Page One</a></li>
            <li><a href='#' data-value='page_two' className={current_slug === 'page_two' ? 'active' : ''} value='page_two' onClick={handleClick}>Page Two</a></li>
            <li><a href='#' data-value='page_three' className={current_slug === 'page_three' ? 'active' : ''} value='page_three' onClick={handleClick}>Page Three</a></li>
        </ul>
    );
}