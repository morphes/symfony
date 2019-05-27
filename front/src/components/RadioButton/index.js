import React, { useState, useDebugValue, useEffect, useMemo } from 'react';
import PropTypes from 'prop-types';
import nanoid from 'nanoid';
import classnames from 'classnames/bind';

import styles from './styles.css';

const cx = classnames.bind(styles);

const RadioButton = ({ checked, className, label, name, value, onChange }) => {
    const [id] = useState(`radio${nanoid()}`);
    const labelClassName = cx(styles.label, className);
    const radioClassName = cx(styles.radio, {
        checked,
    });

    return (
        <label className={labelClassName} htmlFor={id}>
            <input
                className={styles.input}
                id={id}
                type="radio"
                name={name}
                value={value}
                checked={checked}
                onChange={onChange}
            />
            <span className={styles.radioWrapper}>
                <span className={radioClassName} />
            </span>
            {label}
        </label>
    );
};

RadioButton.defaultProps = {
    checked: false,
    className: null,
    required: false,
    value: null,
};

RadioButton.propTypes = {
    checked: PropTypes.bool,
    className: PropTypes.string,
    label: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    value: PropTypes.string,
    onChange: PropTypes.func.isRequired,
};

export default RadioButton;
