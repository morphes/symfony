import React, { useState, useCallback } from 'react';
import PropTypes from 'prop-types';
import { IMaskMixin } from 'react-imask';
import classnames from 'classnames/bind';
import nanoid from 'nanoid';

import styles from './styles.css';

const cx = classnames.bind(styles);

const MaskedInput = IMaskMixin(({ inputRef, ...props }) => <input ref={inputRef} {...props} />);

const Input = ({
    disabled,
    error: errorProp,
    label,
    mask,
    max,
    min,
    name,
    placeholder,
    required,
    text,
    theme,
    type,
    value,
    onChange,
    onBlur,
}) => {
    const generate = useCallback(nanoid(), []);
    const [id] = useState(`input${generate}`);
    const [{ focused, filled, error }, setState] = useState({
        filled: false,
        focused: false,
        error: errorProp,
    });
    const labelClassName = cx(styles.label, theme.label, {
        focused,
        error,
        filled: filled || !!value,
    });
    const inputClassName = cx(styles.input, theme.input, {
        error,
    });
    const textClassName = cx(styles.text, theme.text, {
        error,
    });
    const $Input = mask ? MaskedInput : 'input';

    const handleFocus = () => {
        setState(prevState => ({
            ...prevState,
            filled: true,
            focused: true,
        }));
    };

    const handleBlur = event => {
        setState(prevState => ({
            ...prevState,
            focused: false,
        }));

        const elem = event.target;
        let newError = false;

        if (onBlur) {
            newError = onBlur(elem);
        }

        setState(prevState => ({
            ...prevState,
            error: newError,
            focused: false,
            filled: !!elem.value,
        }));
    };

    return (
        <div className={styles.wrapper}>
            {label && (
                <label className={labelClassName} htmlFor={id}>
                    {required ? `${label}*` : label}
                </label>
            )}
            <$Input
                id={id}
                className={inputClassName}
                type={type}
                name={name}
                value={value}
                mask={mask}
                max={max}
                min={min}
                placeholder={placeholder}
                aria-required={required}
                required={required}
                disabled={disabled}
                onChange={onChange}
                onFocus={handleFocus}
                onBlur={handleBlur}
            />
            {text && <div className={textClassName}>{text}</div>}
        </div>
    );
};

Input.propTypes = {
    label: PropTypes.string,
    mask: PropTypes.string,
    max: PropTypes.string,
    min: PropTypes.string,
    name: PropTypes.string.isRequired,
    placeholder: PropTypes.string,
    required: PropTypes.bool,
    text: PropTypes.string,
    theme: PropTypes.objectOf(PropTypes.string),
    type: PropTypes.string,
    value: PropTypes.string,
    onChange: PropTypes.func,
    onBlur: PropTypes.func,
};

Input.defaultProps = {
    label: null,
    mask: '',
    max: null,
    min: null,
    placeholder: null,
    required: false,
    value: '',
    text: null,
    theme: {},
    type: 'text',
    onBlur: () => {},
};

export default Input;
