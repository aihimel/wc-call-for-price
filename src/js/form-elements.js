import { useState, useEffect } from 'react';

export function Help({ title }) {
    return (
        <span title={ title } data-title={ title } className="wcp-help">Help</span>
    );
}

export function Number( { value, setValue, label, id, name, help, minimum, maximum, step } ) {

    let _minimum = minimum ? minimum : 0;
    let _maximum = maximum ? maximum : Number.MAX_SAFE_INTEGER;
    let _step = step ? step : 1;

    const helpContent = '' !== help ? <Help title={help} />: '';

    const [ _value, _setValue ] = useState( value );

    // useEffect(() => {
    //     _setValue( value );
    // }, []);

    function handleChange( e ) {
        _setValue( e.target.value );
        setValue( e.target.value );
        // console.log(e.target.value);
    }

    return(
        <div className='wcp-field-wrapper'>
            <label htmlFor={ id }>{ label }</label>
            <input
                value={_value}
                type="number"
                id={ id }
                name={ name }
                min={_minimum}
                max={_maximum}
                step={_step}
                onChange={handleChange}
            />
            { helpContent }
        </div>
    );
}