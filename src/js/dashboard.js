import RuleArchive from "./rule-archive";

export default function Dashboard({}) {
    return(
        <>
        <div className='wcp-dashboard-header'>Header Section</div>
        <div className='wcp-dashboard-content'>
            <RuleArchive />
        </div>
        </>
    );
}