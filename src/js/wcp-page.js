import { useContext } from "react";
import { PageContext } from "./wcp-router";

export default function WCPPage({}) {
    const { current_slug, set_current_slug } = useContext( PageContext );

    let content = <></>
    switch ( current_slug ) {
        case "page_two":
            content = <>Page Two</>
            break;
        case "page_three":
            content = <>Page Three</>
            break;
        default:
            content = <>Page One</>
    }
    return(
        <>
            {content}
        </>
    );
}