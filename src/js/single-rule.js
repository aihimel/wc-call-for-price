import { useState } from 'react';
import { Number } from "./form-elements";

export default function SingleRule({}) {
    const [priority, setPriority] = useState(2);

    return (
        <div className='wcp-single-rule-popup-wrapper'>
            <fieldset>
                <legend>General Configuration</legend>
                <div className='wcp-row'>
                    <div className="wcp-col">
                        <div className="wcp-field-wrapper">
                            <input type="checkbox" id="activate" name="activate" />
                            <label htmlFor="activate">Activate</label>
                        </div>
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
        </div>
    );
}