import { useState } from 'react';

// @TODO test if new node package works

export function App({}) {
    const [ input_value, set_input_value ] = useState('');

    const handleChange = (e) => {
        set_input_value(e.target.value);
    }

    return(
        <div>
            <input type='text' value={input_value} onChange={handleChange}/><span>{input_value}</span>
        </div>
    );
};

