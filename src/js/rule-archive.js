import { useContext } from "react";
import { GlobalDataContext } from "./dashboard";
import { WCPNavigationContext } from "./wcp-router";

export function SingleRulePanel({}){
    return(
        <div className='wcp-single-rule-popup-wrapper'>

        </div>
    );
}

export default function RuleArchive({}){

    const { wcpGlobalData, setWcpGlobalData } = useContext( GlobalDataContext );
    const { navigation, setNavigation } = useContext( WCPNavigationContext )

    const handleEdit = ( e ) => {
        e.preventDefault();

    }

    return(
        <div className='wcp-rule-archive-wrapper'>
            <div className='wcp-rule-custom-post'>
                <div className='wcp-rule-post-header'>
                    <h3>NAV: {navigation.current_page_slug}</h3>
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
                            <a href="" className='wcp-edit-rule' data-rule-id='1' onClick={handleEdit}>Edit</a>
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