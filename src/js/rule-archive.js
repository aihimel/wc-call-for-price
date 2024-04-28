import { useContext } from "react";
import { GlobalDataContext } from "./dashboard";
import { WCPNavigationContext } from "./wcp-router";
import { URL_KEY, ADD_EDIT_PAGE } from "./constants";

export function SingleRulePanel({}){
    return(
        <div className='wcp-single-rule-popup-wrapper'>
            Single Rule Edit page
        </div>
    );
}

export default function RuleArchive({}){

    const { wcpGlobalData, setWcpGlobalData } = useContext( GlobalDataContext );

    const handleEdit = ( e ) => {
        e.preventDefault();
        let page_slug = e.target.getAttribute('data-value');
        let _URL = new URL(window.location);
        _URL.searchParams.set( URL_KEY, page_slug );
        history.replaceState( null, '', _URL.toString() );
        setWcpGlobalData( prevState => ({
            ...prevState,
            ...{ navigation:
                    {
                        current_page_slug: page_slug
                    }
            }
        }) );
    }

    return(
        <div className='wcp-rule-archive-wrapper'>
            <div className='wcp-rule-custom-post'>
                <div className='wcp-rule-post-header'>
                    <h3>NAV: {wcpGlobalData.navigation.current_page_slug}</h3>
                    <span className='wcp-rule-active'>Active</span>
                </div>
                <div className='wcp-rule-post-content'>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div className='wcp-rule-post-footer'>
                    <ul>
                        <li>
                            <a href="" className='wcp-edit-rule' data-value={ADD_EDIT_PAGE} data-rule-id='1' onClick={handleEdit}>Edit</a>
                        </li>
                        <li>
                            <a href="" className='wcp-delete-rule'>Delete</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    );
}