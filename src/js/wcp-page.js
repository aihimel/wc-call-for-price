export default function WCPPage({}) {
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
            {content}
        </>
    );
}