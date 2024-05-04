import { useState, useEffect } from 'react';
import { Number, Checkbox, SelectorContainer } from "./form-elements";

export default function SingleRule({}) {
    const [ active, toggleActive ] = useState(false);
    const [ priority, setPriority ] = useState(2);

    return (
        <div className='wcp-single-rule-popup-wrapper'>
            <fieldset>
                <legend>General Configuration</legend>
                <div className='wcp-row'>
                    <div className="wcp-col">
                        <Checkbox
                            checked={active}
                            toggleChecked={toggleActive}
                            label='Activate'
                        />
                        {true}
                    </div>
                    <div className="wcp-col">
                        <Number
                            value={priority}
                            setValue={setPriority}
                            label='Priority'
                            id='priority'
                            name='priority'
                            help='Set Priority'
                        />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Product Selector</legend>
                <div className='wcp-row'>
                    <div className='wcp-col'>
                        <SelectorContainer />
                    </div>
                </div>
            </fieldset>
        </div>
    );
}