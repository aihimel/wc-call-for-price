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

export function SingleRowSelectList({}) {
    const configuration = wcp_rules_configuration;
    console.log( Object.entries(configuration.attributes) );
    return (
        <select>
            <optgroup label={configuration.attributes.product.title}>
                <option value={configuration.attributes.product.all_product.value}>
                    {configuration.attributes.product.all_product.title}
                </option>
                <option value={configuration.attributes.product.category.value}>
                    {configuration.attributes.product.category.title}
                </option>
                <option value={configuration.attributes.product.tag.value}>
                    {configuration.attributes.product.tag.title}
                </option>
                <optgroup label={configuration.attributes.product.inventory.title}>
                    <option value={configuration.attributes.product.inventory.manage_stock.value}>
                        {configuration.attributes.product.inventory.manage_stock.title}
                    </option>
                    <option value={configuration.attributes.product.inventory.stock_status.value}>
                        {configuration.attributes.product.inventory.stock_status.title}
                    </option>
                    <option value={configuration.attributes.product.inventory.minimum_threshold.value}>
                        {configuration.attributes.product.inventory.minimum_threshold.title}
                    </option>
                </optgroup>
                <optgroup >

                </optgroup>
            </optgroup>
        </select>
    );
}

export function SelectorContainer({}) {
    return (
        <div className="wcp-selector-container">
            <div className="wcp-selector-row">
            <SingleRowSelectList />
            </div>
        </div>
    );
}