import { useState } from 'react';

export function Help( props ) {
    return (
        <span title={props.title} data-title={props.title} className="wcp-help">Help</span>
    );
}

export default function SingleRule({}) {
    const [ legend, setLegend ] = useState( 'General Info' );
    function handleChange( e ) {
        setLegend( e.target.value );
    }
    return (
        <div className='wcp-single-rule-popup-wrapper'>
            <fieldset>
                <legend>General Configuration</legend>
                <div className='wcp-row'>
                    <div className="wcp-col">
                        <div className="wcp-field-wrapper checkbox">
                            <input type="checkbox" id="activate" name="activate" />
                            <label htmlFor="activate">Activate</label>
                            <Help title="Hello Title" />
                        </div>
                    </div>
                    <div className="wcp-col">
                        <div className="wcp-field-wrapper checkbox">
                            <label htmlFor="activate">Priority</label>
                            <input type="text" id="priority" name="priority" />
                            <Help title='This is a test title' />
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    );
}