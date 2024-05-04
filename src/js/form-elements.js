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

    function handleChange( e ) {
        setValue( e.target.value );
    }

    return(
        <div className='wcp-field-wrapper'>
            <label htmlFor={ id }>{ label }</label>
            <input
                value={value}
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

export function Checkbox({ checked, toggleChecked, label, id, name, help }) {

    const helpContent = '' !== help ? <Help title={help} />: '';

    function handleChange() {
        toggleChecked(!checked)
    }
    return(
        <div className='wcp-field-wrapper'>
            <input
                type="checkbox"
                checked={checked}
                onChange={handleChange}
                name={name}
            />
            <label htmlFor={id}>{label}</label>
            {helpContent}
        </div>
    );
}

    export function SelectorContainer({}) {
    return(
        <div className='wcp-selector-container'>
            <div className='wcp-selector-row'>
                <select>
                    <option>All Products</option>
                    <optgroup label="Inventory">
                        <option>Stock Management</option>
                        <option disabled={true}>Stock Status</option>
                        <option>Minimum Thresh hold</option>
                        <option disabled={true}>SKU</option>
                    </optgroup>
                </select>
            </div>
        </div>
    );
}