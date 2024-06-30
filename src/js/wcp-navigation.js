import { useState, useContext } from "react";
import { PageContext } from "./wcp-router";

export default function WCPNavigation({}){
    const { current_slug, set_current_slug } = useContext( PageContext );
    const handleClick = ( e ) => {
        e.preventDefault();
        set_current_slug( e.target.getAttribute('data-value') );
        let _URL = new URL(window.location);
        _URL.searchParams.set('dashboard-screen', e.target.getAttribute('data-value') );
        history.replaceState( null, '', _URL.toString() );
    }
    return(
        <>
        <ul>
            <li><a href='#' data-value='page_one' className={current_slug === 'page_one' ? 'active' : ''} onClick={handleClick}>Page One</a></li>
            <li><a href='#' data-value='page_two' className={current_slug === 'page_two' ? 'active' : ''} onClick={handleClick}>Page Two</a></li>
            <li><a href='#' data-value='page_three' className={current_slug === 'page_three' ? 'active' : ''} onClick={handleClick}>Page Three</a></li>
        </ul>
        <div>Current Slug: {current_slug}</div>
        </>
    );
}